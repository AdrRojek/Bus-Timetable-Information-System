@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create User</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name')  }}" required || min:3>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" min:7>
        </div>
        <div class="form-group">
            <label for="admin">Admin:</label>
            <select name="admin" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form></br>
    <a href="{{ url('/admin') }}" class="btn btn-primary">Go Back</a>
</div>
@endsection
