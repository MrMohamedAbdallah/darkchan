<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    <title>{{ env("APP_NAME", "Darkchan") }}</title>
</head>

<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-brand">
                <a href="/">Home</a>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/boards" class="nav-link">Boards</a>
                </li>
                <li class="nav-item">
                    <a href="/boards/create" class="nav-link">create</a>
                </li>
            </ul>
        </div>
    </nav>