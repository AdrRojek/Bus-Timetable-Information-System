@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Szczegóły użytkownika</h1>

    <p>Imię: {{ $user->first_name }}</p>
    <p>Nazwisko: {{ $user->last_name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Admin: {{ $user->admin ? 'Tak' : 'Nie' }}</p>
</div>
@endsection
