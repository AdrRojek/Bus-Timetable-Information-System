@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        @if (Auth::user()->id === $user->id)  
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
        @endif

        @if (Auth::user()->isAdmin())
            <div class="form-group">
                <label for="admin">Admin:</label>
                <select name="admin" class="form-control">
                    <option value="0" {{ $user->admin ? '' : 'selected' }}>No</option>
                    <option value="1" {{ $user->admin ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Go back</a>
    </form>
</div>
@endsection
