@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Stops</h1>
    <a href="{{ route('admin.stops.create') }}" class="btn btn-primary">Add Stop</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stops as $stop)
                <tr>
                    <td>{{ $stop->id }}</td>
                    <td>{{ $stop->name }}</td>
                    <td>{{ $stop->address }}</td>
                
            
            <td>
                @if($stop->stoppic)
                    <img src="{{ Storage::url('stops/'.$stop->stoppic) }}" width="80" height="55" class="zoom">
                @else
                    No Picture
                @endif
            </td>
        
                    <td>
                        <a href="{{ route('admin.stops.edit', $stop->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.stops.destroy', $stop->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <a href="{{ url('/admin') }}" class="btn btn-primary">Go Back</a></br>
            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        </tbody>
    </table>
</div>
<style>
.zoom {
  transition: transform .2s; 
  margin: 0 auto;
}

.zoom:hover {
  transform: scale(6); 
}
</style>
@endsection
