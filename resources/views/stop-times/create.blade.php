@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Stop Times</h1>
    <a href="{{ route('stop-times.create') }}" class="btn btn-primary">Create Stop Time</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Route</th>
                <th>Stop</th>
                <th>Arrival Time</th>
                <th>Departure Time</th>
                <th>Stop Sequence</th>
                <th>Next Stop</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stopTimes as $stopTime)
                <tr>
                    <td>{{ $stopTime->id }}</td>
                    <td>{{ $stopTime->route->name }}</td>
                    <td>{{ $stopTime->stop->name }}</td>
                    <td>{{ $stopTime->arrival_time }}</td>
                    <td>{{ $stopTime->departure_time }}</td>
                    <td>
                        <a href="{{ route('stop-times.show', $stopTime->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('stop-times.edit', $stopTime->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('stop-times.destroy', $stopTime->id) }}" method="POST" style="display:inline-block;">
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
