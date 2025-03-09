@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Stop</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.stops.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <div class="form-group">
            <label for="stoppic">Stop Picture</label>
            <input type="file" class="form-control" id="stoppic" name="stoppic" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
