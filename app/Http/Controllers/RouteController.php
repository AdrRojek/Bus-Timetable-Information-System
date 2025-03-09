<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Stop;
use App\Models\User;
use App\Models\StopTime;
use Carbon\Carbon;
use Auth;
use App\Charts\MonthlyRoutesChart;

class RouteController extends Controller
{
    public function index()
{
    $routes = Route::all(); 
    return view('routes.index', compact('routes'));
}

public function create()
{
    $stops = Stop::whereDoesntHave('stopTimes')->get();

    return view('routes.create', compact('stops'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'stops' => 'required|array'
    ]);

    foreach ($request->stops as $stopId) {
        $stopExists = StopTime::where('stop_id', $stopId)->exists();
        if ($stopExists) {
            return redirect()->route('routes.create')->with('error', 'One or more stops are already assigned to another route.');
        }
    }

    $route = Route::create($request->only('name', 'description'));
    $route->stops()->sync($request->stops);

    foreach ($request->stops as $key => $stopId) {
        $stopTime = new StopTime;
        $stopTime->route_id = $route->id; 
        $stopTime->stop_id = $stopId;
        $stopTime->arrival_time = '00:00:00';
        $stopTime->departure_time = '00:01:00';
        $stopTime->save();
    }

    return redirect()->route('routes.index')->with('success', 'Route created successfully.');
}

    public function edit($id)
    {
        $route = Route::findOrFail($id);
        $stops = Stop::all();
        $users = User::where('admin', false)->get();
        return view('routes.edit', compact('route', 'stops', 'users'));
        
    }

public function show($id)
{
    $route = Route::with('stopTimes.stop')->find($id);

    if (!$route) {
        return redirect()->route('routes.index')->with('error', 'Route not found.');
    }

    return view('routes.show', compact('route'));
}


public function createStop($id)
{
    $route = Route::find($id);
    $stops = Stop::all();
    return view('stops.create', compact('route', 'stops'));
}

public function showAddStopsForm($routeId)
{
    $route = Route::findOrFail($routeId);
    $stops = Stop::whereDoesntHave('stopTimes')->get();  
    return view('routes.stop_add', compact('route', 'stops'));
}


    public function addStops(Request $request, $routeId)
{
    $request->validate([
        'stops' => 'required|array',
        'stops.*' => 'exists:stops,id',
    ]);

    $route = Route::findOrFail($routeId);
    $stopIds = $request->input('stops', []);
    $route->stops()->attach($stopIds);

    return redirect()->route('routes.show', $route->id)->with('success', 'Przystanki dodane pomyślnie.');
}

    
    public function assignStops(Request $request, $routeId)
    {
        $route = Route::findOrFail($routeId);
        foreach ($request->stop_ids as $stopId) {
            StopTime::create([
                'route_id' => $route->id,
                'stop_id' => $stopId,
                'arrival_time' => now(),
                'departure_time' => now()->addMinutes(1),
            ]);
        }

        return redirect()->route('routes.show', $route->id)->with('success', 'Przystanki zostały dodane do trasy.');

    }

    
    public function yourRouteAction()
    {
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();

        $monthLabels = [];
        $currentDate = $startOfMonth->copy();
        while ($currentDate <= $endOfMonth) {
            $monthLabels[] = $currentDate->format('d MMM');
            $currentDate->addDay();
        }

        $routeCounts = [];
        $currentDate = $startOfMonth->copy();
        while ($currentDate <= $endOfMonth) {
            $count = Route::whereHas('routeDates', function ($query) use ($currentDate) {
                $query->whereDate('date', $currentDate);
            })->count();
            $routeCounts[$currentDate->format('d MMM')] = $count;
            $currentDate->addDay();
        }

        foreach ($monthLabels as $label) {
            if (!isset($routeCounts[$label])) {
                $routeCounts[$label] = 0;
            }
        }

        $userId = Auth::id();
        $routes = Route::where('user_id', $userId)->get();

        $weeklyHours = [];
        $currentWeekStart = $startOfMonth->copy()->startOfWeek();

        while ($currentWeekStart <= $endOfMonth) {
            $currentWeekEnd = $currentWeekStart->copy()->endOfWeek();
            $totalDurationMinutesForTheWeek = 0;

            foreach ($routes as $route) {
                foreach ($route->routeDates as $date) {
                    if ($date->date->isBetween($currentWeekStart, $currentWeekEnd)) {
                        $firstStopTime = StopTime::where('route_id', $route->id)->orderBy('arrival_time')->first();
                        $lastStopTime = StopTime::where('route_id', $route->id)->orderBy('departure_time', 'desc')->first();

                        if ($firstStopTime && $lastStopTime) {
                            $startTime = Carbon::parse($firstStopTime->arrival_time);
                            $endTime = Carbon::parse($lastStopTime->departure_time);
                            $totalDurationMinutesForTheWeek += $startTime->diffInMinutes($endTime, true);
                        }
                    }
                }
            }

            $totalDurationHoursForTheWeek = floor($totalDurationMinutesForTheWeek / 60);
            $weeklyHours[$currentWeekStart->format('d M') . ' - ' . $currentWeekEnd->format('d M')] = $totalDurationHoursForTheWeek;

            $currentWeekStart->addWeek();
        }

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $currentWeekRoutes = Route::whereHas('routeDates', function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
        })->count();

        $totalDuration = 0;
        $routeDurations = [];
        foreach ($routes as $route) {
            $routeDuration = 0;
            foreach ($route->routeDates as $date) {
                if ($date->date->isBetween($startOfWeek, $endOfWeek)) {
                    $firstStopTime = StopTime::where('route_id', $route->id)->orderBy('arrival_time')->first();
                    $lastStopTime = StopTime::where('route_id', $route->id)->orderBy('departure_time', 'desc')->first();

                    if ($firstStopTime && $lastStopTime) {
                        $startTime = Carbon::parse($firstStopTime->arrival_time);
                        $endTime = Carbon::parse($lastStopTime->departure_time);
                        $routeDuration += $startTime->diffInMinutes($endTime, true); 
                    }
                }
            }
            $routeDurations[$route->id] = $routeDuration;
            $totalDuration += $routeDuration;
        }

        $totalDurationHours = floor($totalDuration / 60);
        $totalDurationMinutes = $totalDuration % 60;
       

        return view('routes.your', [
            'monthLabels' => $monthLabels,
            'routeCounts' => $routeCounts,
            'currentWeekRoutes' => $currentWeekRoutes,
            'totalDurationHours' => $totalDurationHours,
            'totalDurationMinutes' => $totalDurationMinutes,
            'routes' => $routes,
            'routeDurations' => $routeDurations,
            'weeklyHours' => $weeklyHours,
        ]);
    }

    public function getChartData()
{
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    $routeCounts = Route::selectRaw('DATE_FORMAT(route_dates.date, "%d %b") as label, COUNT(*) as count')
        ->join('route_dates', 'routes.id', '=', 'route_dates.route_id')
        ->whereMonth('route_dates.date', $currentMonth)
        ->whereYear('route_dates.date', $currentYear)
        ->groupBy('label')
        ->orderBy('route_dates.date')
        ->pluck('count', 'label');

    $allDays = [];
    $startDate = Carbon::now()->startOfMonth();
    while ($startDate->month == $currentMonth) {
        $allDays[] = $startDate->format('d M');
        $startDate->addDay();
    }
    $routeCounts = collect($routeCounts)->union(array_fill_keys($allDays, 0))->sortKeys();

    return response()->json([
        'labels' => $routeCounts->keys()->toArray(),
        'counts' => $routeCounts->values()->toArray(),
    ]);
}


public function destroy(Route $route)
{
    $route->stopTimes()->delete();
    $route->routeDates()->delete();

    $route->delete();

    return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
}



    
    

}
