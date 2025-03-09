@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edytuj użytkownika</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name">Imię</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Nazwisko</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="admin">Admin</label>
            <select class="form-control" id="admin" name="admin">
                <option value="0" @if (!$user->admin) selected @endif>Nie</option>
                <option value="1" @if ($user->admin) selected @endif>Tak</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Zaktualizuj użytkownika</button>
    </form>
</div>
@endsection
