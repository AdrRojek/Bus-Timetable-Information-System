<?php
namespace App\Http\Controllers;

use App\Models\StopTime;
use App\Models\Route;
use App\Models\Stop;
use Illuminate\Http\Request;

class StopTimeController extends Controller
{
    public function index()
    {
        $stopTimes = StopTime::with('route', 'stop', 'nextStop')->get();
        return view('stop-times.index', compact('stopTimes'));
    }

    public function create()
    {
        $routes = Route::all();
        $stops = Stop::all();
        return view('stop-times.create', compact('routes', 'stops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'stop_id' => 'required|exists:stops,id',
            'arrival_time' => 'required|date_format:H:i:s',
            'departure_time' => 'required|date_format:H:i:s',
        ]);

        StopTime::create($request->all());
        return redirect()->route('stop-times.index')->with('success', 'Stop Time created successfully.');
    }

    public function show(StopTime $stopTime)
    {
        $stopTime->load('route', 'stop', 'nextStop');
        return view('stop-times.show', compact('stopTime'));
    }

    public function edit($id)
    {
        $stopTime = StopTime::with('route', 'stop')->findOrFail($id);
        return view('stop-times.edit', compact('stopTime'));
    }
    
    public function update(Request $request, $id)
{
    $stopTime = StopTime::find($id);

    if (!$stopTime) {
        return redirect()->route('routes.index')->with('error', 'StopTime not found.');
    }

    $stop = $stopTime->stop;

    if ($request->hasFile('stoppic')) {
        $path = $request->file('stoppic')->store('public/stops');
        $fileName = basename($path);
        $stop->stoppic = $fileName;
    }

    if ($request->has('name')) {
        $stop->name = $request->input('name');
    }

    if ($request->has('address')) {
        $stop->address = $request->input('address');
    }

    if ($request->has('arrival_time')) {
        $arrivalTime = $request->input('arrival_time');

        // Sprawdzenie czy czas przyjazdu istnieje dla danego route_id
        $existingStopTime = StopTime::where('route_id', $stopTime->route_id)
            ->where('arrival_time', $arrivalTime)
            ->first();

        if ($existingStopTime) {
            return redirect()->back()->with('error', 'This arrival time already exists for this route.');
        }

        $departureTime = date('H:i', strtotime($arrivalTime . ' +1 minute'));
        $stopTime->arrival_time = $arrivalTime;
        $stopTime->departure_time = $departureTime;
    }

    $stop->save();
    $stopTime->save();

    return redirect()->route('routes.show', $stopTime->route_id)->with('success', 'Stop and times updated successfully.');
}

    



    

    
    public function destroy($id)
    {
        $stopTime = StopTime::findOrFail($id);

        $stopTime->delete();

        return redirect()->back()->with('success', 'StopTime deleted successfully.');
    }
}
