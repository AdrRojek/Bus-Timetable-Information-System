@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Route Date Details</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $routeDate->id }}</td>
        </tr>
        <tr>
            <th>Route</th>
            <td>{{ $routeDate->route->name }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $routeDate->date }}</td>
        </tr>
    </table>
    <a href="{{ route('route-dates.index') }}" class="btn btn-primary">Back to Route Dates</a>
</div>
@endsection
