<!-- resources/views/routes/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Route</h1>
    <form action="{{ route('routes.update', $route->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $route->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $route->description }}</textarea>
        </div>
        @foreach ($route->stopTimes as $stopTime)
            <div class="form-group">
                <label for="arrival_time_{{ $stopTime->id }}">Czas przyjazdu ({{ $stopTime->stop->name }})</label>
                <input type="time" class="form-control" id="arrival_time_{{ $stopTime->id }}" name="arrival_times[{{ $stopTime->id }}]" value="{{ $stopTime->arrival_time }}">

                <label for="departure_time_{{ $stopTime->id }}">Czas odjazdu ({{ $stopTime->stop->name }})</label>
                <input type="time" class="form-control" id="departure_time_{{ $stopTime->id }}" name="departure_times[{{ $stopTime->id }}]" value="{{ $stopTime->departure_time }}">
                
                <a href="{{ route('stop_times.edit', $stopTime->id) }}" class="btn btn-primary">Edit Stop Time</a>
            </div>
        @endforeach
        <div class="form-group">
            <label for="stops">Stops</label>
            <select multiple class="form-control" id="stops" name="stops[]" required>
                @foreach($stops as $stop)
                    <option value="{{ $stop->id }}" {{ $route->stops->contains($stop->id) ? 'selected' : '' }}>{{ $stop->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user_id">Driver</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $route->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Route</button>
    </form>
</div>
@endsection
