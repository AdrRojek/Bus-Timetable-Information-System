@foreach ($routeInfo as $route)
    <a class="dropdown-item" href="{{ route('routes', ['id' => $route['id']]) }}">{{ $route['name'] }}</a>
@endforeach
