<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Application</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        .navbar-nav {
            flex-direction: row;
        }
        .nav-link {
            padding-right: 1rem !important;
            padding-left: 1rem !important;
        }
        .navbar{background-color: #9CFC97;}
        body{
            background-color: #E6FAFC;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>
<body>

    <nav class="navbar navbar-expand">
        <a class="navbar-brand" href="/">Bus-Info</a>
        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('routes.index') }}">Routes</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('your.routes') }}">Your Routes</a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->isAdmin())
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">Admin Panel</a>
    </li>
@endif

            </ul>
            <ul class="navbar-nav ml-auto">
            @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.show', Auth::user()) }}">Profile</a>
    </li>
@endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    @stack('scripts')

</body>
</html>
