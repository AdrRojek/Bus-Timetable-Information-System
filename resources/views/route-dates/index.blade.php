@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Route Dates</h1>
    <a href="{{ route('route-dates.create') }}" class="btn btn-primary">Create Route Date</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Route</th>
                <th>Date</th>
                <th>Exception Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routeDates as $routeDate)
                <tr>
                    <td>{{ $routeDate->id }}</td>
                    <td>{{ $routeDate->route->name }}</td>
                    <td>{{ $routeDate->date }}</td>
                    <td>
                        <a href="{{ route('route-dates.show', $routeDate->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('route-dates.edit', $routeDate->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('route-dates.destroy', $routeDate->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
