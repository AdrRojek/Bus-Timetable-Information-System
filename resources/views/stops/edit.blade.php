@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Stop</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif 

    <form method="POST" action="{{ route('stop.update', $stop->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $stop->name) }}"> 
            @error('name') 
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $stop->address) }}">
            @error('address') 
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="stoppic">Stop Picture</label>
            <input type="file" class="form-control @error('stoppic') is-invalid @enderror" id="stoppic" name="stoppic" accept="image/png, image/gif, image/jpeg">
            @error('stoppic')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('admin.stops.index')}}" class="btn btn-secondary">Powrót</a> 
    </form>
</div>
@endsection
