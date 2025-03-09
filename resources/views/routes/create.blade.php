@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Route</h1>
    <form action="{{ route('admin.routes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="stops">Stops</label>
            <div>
                @foreach($stops as $stop)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="stop{{ $stop->id }}" name="stops[]" value="{{ $stop->id }}">
                        <label class="form-check-label" for="stop{{ $stop->id }}">{{ $stop->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create Route</button>
    </form>
</div>
@endsection
