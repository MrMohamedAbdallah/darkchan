<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('css/custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <link rel="stylesheet" href="{{{ asset('css/style.min.css') }}}" />

    {{-- Recaptcha --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>{{ config("app.name", "Darkchan") }}</title>
</head>

<body class="">
    <!-- ============================= -->
    <!--            Navbar             -->
    <!-- ============================= -->
    <nav class="navbar">
        <div class="container">
            <ul class="navbar-nav">
                <li>
                    <a href="{{ route("home") }}" class="{{ activeLink("/") }}"><i class="fas fa-home"></i>Home</a>
                </li>
                <li>
                    <a href="{{ route("boards") }}" class="{{ activeLink("boards") }}"><i class="fas fa-tag"></i>Boards</a>
                </li>
                <li>
                    <a href="{{ route("boards.sfw") }}" class="{{ activeLink("boards/sfw") }}"><i class="fas fa-briefcase"></i>SFW boards</a>
                </li>
                <li>
                    <a href="{{ route("boards.nsfw") }}" class="{{ activeLink("boards/nsfw") }}"><i class="fas fa-hand-paper"></i>NSFW boards</a>
                </li>
                @auth
                @if(auth()->user()->is_owner)
                <li>
                    <a href="{{ route("board.create") }}"><i class="fas fa-hand-paper"></i>Create Board</a>
                </li>
                <li>
                    <a href="{{ route('users') }}"><i class="fas fa-users"></i>Users</a>
                </li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
                @else
                <li>
                    <a href="/login" class="{{ activeLink("login") }}"><i class="fas fa-sign-in-alt"></i>Login</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>