@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj przystanki do trasy: {{ $route->name }}</h1>

    <form action="{{ route('routes.stop_add.store', $route->id) }}" method="POST">
        @csrf

        <table class="table">
            <thead>
                <tr>
                    <th>Wybierz</th>
                    <th>Nazwa przystanku</th>
                    <th>Adres</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stops as $stop)
                    <tr>
                        <td>
                            <input type="checkbox" name="stops[]" value="{{ $stop->id }}">
                        </td>
                        <td>{{ $stop->name }}</td>
                        <td>{{ $stop->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Akceptuj</button>
    </form>

    <a href="{{ route('routes.show', $route->id) }}" class="btn btn-secondary">Powrót</a>
</div>
@endsection
