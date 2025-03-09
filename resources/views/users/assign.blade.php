@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Route Assignment</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Name and Surname</th>
                <th scope="col" style="width: 18%;">New Route</th>
                <th scope="col" style="width: 40%;">Assigned routes and days</th>
                <th scope="col" style="width: 18%;">Remove Route</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>
                        <form id="form-{{ $user->id }}" action="{{ route('admin.assign-route.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <select name="route_id" required style="width:250px">
                                <option value="">Choose the route</option>
                                @foreach($routes as $route)
                                    @if (!$route->user || $route->user->id == $user->id)
                                        <option value="{{ $route->id }}">{{ $route->name }} @if($route->user) (Assigned to this user) @endif</option>
                                    @endif
                                @endforeach
                            </select><br>
                            <input type="date" name="date" required>
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </form>
                    </td>
                    <td>
                        @php $currentRouteName = null; @endphp 
                        @foreach($user->routeDates->sortBy('date') as $routeDate)
                            @if($routeDate->date >= now())
                                @if ($routeDate->route->name !== $currentRouteName)
                                    {{ $routeDate->route->name }}:<br>
                                    @php $currentRouteName = $routeDate->route->name; @endphp 
                                @endif
                                {{ $routeDate->date->format('Y-m-d') }}<br>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('admin.remove-route.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <select name="route_date_id" required style="width:250px">
                                <option value="">Choose the route to remove</option>
                                @foreach($user->routeDates as $routeDate)
                                    @if($routeDate->date >= now())
                                        <option value="{{ $routeDate->id }}">{{ $routeDate->route->name }}: {{ $routeDate->date->format('Y-m-d') }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <a href="{{ url('/admin') }}" class="btn btn-primary">Go Back</a>
        </tbody>
    </table>
</div>
@endsection
