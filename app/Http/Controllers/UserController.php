<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        
        return view('users.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'first_name' => 'required|max:100|min:3',
            'last_name' => 'required|max:100|min:3',
            'admin' => 'required|boolean',
            'email' => 'required|min:5|max:100|email',
            'password' => 'required|min:7|max:100',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $user = User::create($input);

        return redirect()->route('users.show', $user)->with('success', 'User created successfully.');
    }

    public function show(User $user)
{
    if (auth()->user()->id !== $user->id && !auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }
    return view('users.show', compact('user'));
}


public function edit(User $user)
{
    if (auth()->user()->id !== $user->id && !auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }
    return view('users.edit', compact('user'));
}


public function update(Request $request, User $user)
{
    if (auth()->user()->id !== $user->id && !auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'first_name' => 'required|max:100|min:3',
        'last_name'  => 'required|max:100|min:3',
        'email'      => 'required|email|min:5|max:100',
        'password' => 'nullable|confirmed|min:7',
    ]);

    $dataToUpdate = $request->only(['first_name', 'last_name', 'email']);
    
    if (auth()->user()->isAdmin()) {
        $dataToUpdate['admin'] = $request->input('admin');
    }

    if ($request->filled('password')) {
        $dataToUpdate['password'] = bcrypt($request->password);
    }

    $user->update($dataToUpdate);

    $redirectRoute = auth()->user()->isAdmin() ? 'users.index' : 'users.show';

    return redirect()->route($redirectRoute, $user)->with('success', 'User updated successfully.');
}


public function destroy(User $user)
{
    if (!Auth::user()->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    // Set user_id to null for all routes associated with the user
    $user->routes()->update(['user_id' => null]);

    // Delete the user
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}
}
