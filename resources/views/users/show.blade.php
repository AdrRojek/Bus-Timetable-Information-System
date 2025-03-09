@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>First Name</th>
            <td>{{ $user->first_name }}</td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <th>Admin</th>
            <td>{{ $user->admin ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
    </table>

    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
</div>
@endsection
