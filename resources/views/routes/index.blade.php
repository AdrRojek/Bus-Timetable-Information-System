@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Available Routes</h1>
    <div class="form-group">
        <label for="routeSelect">Select a Route</label>
        <select class="form-control" id="routeSelect" onchange="location = this.value;">
            <option value="">Choose...</option>
            @foreach ($routes as $route)
    <option value="{{ route('routes.show', ['id' => $route->id]) }}">
        {{ $route->name }}
    </option>
@endforeach


        </select>
    </div>
</div>
@endsection
