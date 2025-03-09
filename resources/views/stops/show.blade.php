@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Stop Details</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $stop->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $stop->name }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $stop->address }}</td>
        </tr>
       
    </table>
    <a href="{{ route('stops.index') }}" class="btn btn-primary">Back to Stops</a>
</div>
@endsection
