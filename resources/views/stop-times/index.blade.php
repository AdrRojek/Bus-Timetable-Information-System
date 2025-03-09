@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Route Details</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $route->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $route->name }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $route->description }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td>{{ $route->user->first_name }} {{ $route->user->last_name }}</td>
        </tr>
    </table>
    <a href="{{ route('routes.index') }}" class="btn btn-primary">Back to Routes</a>
</div>
@endsection
