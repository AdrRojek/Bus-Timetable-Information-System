@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Stop Time</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('stop-times.update', $stopTime->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="route_id">Route:</label>
            <select name="route_id" class="form-control">
                @foreach($routes as $route)
                    <option value="{{ $route->id }}" {{ $route->id == $stopTime->route_id ? 'selected' : '' }}>
                        {{ $route->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="stop_id">Stop:</label>
            <select name="stop_id" class="form-control">
                @foreach($stops as $stop)
                    <option value="{{ $stop->id }}" {{ $stop->id == $stopTime->stop_id ? 'selected' : '' }}>
                        {{ $stop->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="arrival_time">Arrival Time:</label>
            <input type="text" name="arrival_time" class="form-control" value="{{ $stopTime->arrival_time }}">
        </div>
        <div class="form-group">
            <label for="departure_time">Departure Time:</label>
            <input type="text" name="departure_time" class="form-control" value="{{ $stopTime->departure_time }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
