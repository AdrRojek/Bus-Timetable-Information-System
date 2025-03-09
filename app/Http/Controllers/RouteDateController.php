<?php
namespace App\Http\Controllers;

use App\Models\RouteDate;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteDateController extends Controller
{
    public function index()
    {
        $routeDates = RouteDate::with('route')->get();
        return view('route-dates.index', compact('routeDates'));
    }

    public function create()
    {
        $routes = Route::all();
        return view('route-dates.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'date' => 'required|date',
        ]);

        RouteDate::create($request->all());
        return redirect()->route('route-dates.index')->with('success', 'Route Date created successfully.');
    }

    public function show(RouteDate $routeDate)
    {
        $routeDate->load('route');
        return view('route-dates.show', compact('routeDate'));
    }

    public function edit(RouteDate $routeDate)
    {
        $routes = Route::all();
        return view('route-dates.edit', compact('routeDate', 'routes'));
    }

    public function update(Request $request, RouteDate $routeDate)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'date' => 'required|date',
        ]);

        $routeDate->update($request->all());
        return redirect()->route('route-dates.index')->with('success', 'Route Date updated successfully.');
    }

    public function destroy(RouteDate $routeDate)
    {
        $routeDate->delete();
        return redirect()->route('route-dates.index')->with('success', 'Route Date deleted successfully.');
    }
}
