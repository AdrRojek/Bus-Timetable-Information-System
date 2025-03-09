@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj użytkownika</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="first_name">Imię</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Nazwisko</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Hasło</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="admin">Admin</label>
            <select class="form-control" id="admin" name="admin">
                <option value="0">Nie</option>
                <option value="1">Tak</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Dodaj użytkownika</button>
    </form>
</div>
@endsection
