<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\RouteDate;
use App\Models\User;
use App\Models\Stop;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function assignRouteForm()
    {
        $users = User::all();
        $routes = Route::all();
        return view('admin.assign-route', compact('users', 'routes'));
    }

    public function showAssignRouteForm()
    {
        $users = User::all();
        $routes = Route::all();

        return view('users.assign', [
            'users' => $users,
            'routes' => $routes,
        ]);
    }

    public function assignRoute(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'route_id' => 'required|exists:routes,id',
            'date' => 'required|date',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $route = Route::findOrFail($request->input('route_id'));
        $date = $request->input('date');

        if (strtotime($date) < strtotime(date('Y-m-d'))) {
            return redirect()->route('admin.assign')->with('error', 'You cannot assign a route on a past date.');
        }

        $routeAssignedToOtherUser = Route::where('id', $route->id)
            ->where('user_id', '!=', $user->id)
            ->where('user_id', '!=', null) 
            ->exists();

        if ($routeAssignedToOtherUser) {
            return redirect()->back()->withInput()->with('error', 'This route is already assigned to another user.');
        }

        $existingRouteDate = RouteDate::where('route_id', $route->id)
            ->where('date', $date)
            ->exists();

        if ($existingRouteDate) {
            return redirect()->back()->withInput()->with('error', 'This route is already assigned on this date.');
        }

        $route->update(['user_id' => $user->id]);

        RouteDate::create([
            'route_id' => $route->id,
            'date' => $date,
        ]);

        return redirect()->route('admin.assign')->with('success', 'Route assigned successfully.');
    }

    public function removeRoute(Request $request)
    {
        $request->validate([
            'route_date_id' => 'required|exists:route_dates,id',
        ]);

        $routeDate = RouteDate::findOrFail($request->input('route_date_id'));

        $route = $routeDate->route;

        $routeDate->delete();

        $routeHasOtherDates = RouteDate::where('route_id', $route->id)->exists();

        if (!$routeHasOtherDates) {
            $route->update(['user_id' => null]);
        }

        return redirect()->route('admin.assign')->with('success', 'Route removed successfully.');
    }

    public function create()
    {
        $stops = Stop::all();
        $users = User::where('admin', false)->get();
        return view('admin.routes.create', compact('stops', 'users'));
    }

}
