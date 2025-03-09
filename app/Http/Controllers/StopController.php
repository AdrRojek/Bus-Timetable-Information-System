<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stop;
use App\Models\StopTime;
use App\Models\Route;
use Illuminate\Support\Facades\Storage;


class StopController extends Controller
{
    public function index()
{
    $stops = Stop::all();
    return view('stops.index', compact('stops'));
}

    public function create()
    {
        return view('stops.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255|min:3',
        'address' => 'required|max:255|min:3',
        'stoppic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);

    $stop = new Stop;
    $stop->name = $request->name;
    $stop->address = $request->address;

    $path = $request->file('stoppic')->store('public/stops');
    $fileName = basename($path);
    $stop->stoppic = $fileName;

    if ($stop->save()) {
        return redirect()->route('admin.stops.index')->with('success', 'Stop created successfully.');
    } else {
        return redirect()->route('stops.create')->with('error', 'Failed to create stop.');
    }
}

public function edit($id)
{
    $stop = Stop::find($id);
    return view('stops.edit', compact('stop'));
}

public function destroy($id)
{
    $stop = Stop::find($id);

    if (StopTime::where('stop_id', $id)->exists()) {
        return redirect()->route('admin.stops.index')->with('error', 'Cannot delete stop. It is currently used in route.');
    }

    Storage::delete('public/stops/' . $stop->stoppic);
    $stop->delete();
    return redirect()->route('admin.stops.index')->with('success', 'Stop deleted successfully.');
}

public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'stoppic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $stop = Stop::findOrFail($id);
            $stop->name = $request->input('name');
            $stop->address = $request->input('address');

            if ($request->hasFile('stoppic')) {
                Storage::delete('public/stops/' . $stop->stoppic);
                $path = $request->file('stoppic')->store('public/stops');
                $fileName = basename($path);
                $stop->stoppic = $fileName;
            }

            $stop->save();

            return redirect()->route('admin.stops.index')->with('success', 'Stop updated successfully.');

        } catch (ValidationException $e) {
            $errorMessage = 'Unable to update the stop. Please check the following:';
            foreach ($e->errors() as $field => $errors) {
                $errorMessage .= "\n- $field: " . implode(', ', $errors);
            }
            return redirect()->back()
                ->withInput($request->all())
                ->with('error', $errorMessage);
        }
    }
 
public function addStops(Request $request, $routeId)
{
    $route = Route::findOrFail($routeId);
    $stopIds = $request->input('stops', []);
    $route->stops()->attach($stopIds);

    return redirect()->route('routes.show', $route->id)->with('success', 'Przystanki dodane pomyślnie.');
}

}
