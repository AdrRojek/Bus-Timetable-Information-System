@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Stop and Time</h1>

    <form method="POST" action="{{ route('stop_times.update', ['stop_time' => $stopTime->id, 'route_id' => $stopTime->route_id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="route_id" value="{{ $stopTime->route_id }}">

        <div class="form-group">
            <label for="name">Stop Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $stopTime->stop->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $stopTime->stop->address) }}" required>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="arrival_time">Arrival Time</label>
            <input type="time" class="form-control @error('arrival_time') is-invalid @enderror" id="arrival_time" name="arrival_time" value="{{ old('arrival_time', $stopTime->arrival_time) }}" required>
            @error('arrival_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stoppic">Stop Picture</label>
            <input type="file" class="form-control @error('stoppic') is-invalid @enderror" id="stoppic" name="stoppic">
            @error('stoppic')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="{{ url('/admin') }}" class="btn btn-secondary">Go back</a> 
    </form>
</div>
@endsection
