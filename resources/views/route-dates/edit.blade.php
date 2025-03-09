@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Route Date</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('route-dates.update', $routeDate->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="route_id">Route:</label>
            <select name="route_id" class="form-control">
                @foreach($routes as $route)
                    <option value="{{ $route->id }}" {{ $route->id == $routeDate->route_id ? 'selected' : '' }}>
                        {{ $route->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" value="{{ $routeDate->date }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
