@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Panel</h1>

    <div class="my-4">
        <h2>Users</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Show Users</a>
    </div>

    <div class="my-4">
        <h2>Routes</h2>
        <a href="{{ route('admin.routes.create') }}" class="btn btn-primary">Add Route</a>
        <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary">Show Routes</a>
    </div>

    <div class="my-4">
        <h2>Stops</h2>
        <a href="{{ route('admin.stops.create') }}" class="btn btn-primary">Add Stop</a>
        <a href="{{ route('admin.stops.index') }}" class="btn btn-secondary">Show Stops</a>
    </div>

    <div class="my-4">
        <h2>Route Assignment</h2>
        <a href="{{ route('admin.assign') }}" class="btn btn-primary">Assign Route</a>
    </div>
</div>
@endsection
