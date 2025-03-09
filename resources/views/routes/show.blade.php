@extends('layouts.app')

@section('content')
<div class="container">
    @if ($route)
        <h1>{{ $route->name }}</h1>
        <p>{{ $route->description }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Stop Name</th>
                    <th>Address</th>
                    <th>Arrival Time</th>
                    <th>Departure Time</th>
                    <th>Picture</th>
                    @if (auth()->check() && auth()->user()->isAdmin())
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($route->stopTimes->sortBy('arrival_time') as $stopTime) 
                    <tr>
                        <td>{{ $stopTime->stop->name }}</td>
                        <td>{{ $stopTime->stop->address }}</td>
                        <td>{{ $stopTime->arrival_time }}</td>
                        <td>{{ $stopTime->departure_time }}</td>
                        <td>
                            @if ($stopTime->stop->stoppic)
                                <img src="{{ Storage::url('stops/' . $stopTime->stop->stoppic) }}" width="80" height="55" class="zoom">
                            @else
                                Brak zdjęcia
                            @endif
                        </td>
                        @if (auth()->check() && auth()->user()->isAdmin())
                            <td>
                                <a href="{{ route('stop_times.edit', $stopTime->id) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('stop_times.destroy', $stopTime->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('routes.stop_add', $route->id) }}" class="btn btn-primary">Add Stop</a>

            <form method="POST" action="{{ route('routes.destroy', $route->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this route?')">Delete Route</button>
            </form>
        @endif
    @else
        <p>Route not found.</p>
    @endif
    <a href="{{ url('/') }}" class="btn btn-primary">Go back</a>
</div>

<style>   .zoom {
        transition: transform .2s; 
        margin: 0 auto;
    }

    .zoom:hover {
        transform: scale(6); 
 } </style>

@endsection
