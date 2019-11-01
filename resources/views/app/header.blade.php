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
                    <a href="{{ route("home") }}"><i class="fas fa-home"></i>Home</a>
                </li>
                <li>
                    <a href="{{ route("boards") }}"><i class="fas fa-tag"></i>Boards</a>
                </li>
                <li>
                    <a href="{{ route("boards.sfw") }}"><i class="fas fa-briefcase"></i>SFW boards</a>
                </li>
                <li>
                    <a href="{{ route("boards.nsfw") }}"><i class="fas fa-hand-paper"></i>NSFW boards</a>
                </li>
                <li>
                    <a href="/login" class="active"><i class="fas fa-sign-in-alt"></i>Login</a>
                </li>
            </ul>
        </div>
    </nav>