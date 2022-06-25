<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle') - {{ config('app.name') }}</title>

    <!-- favicon -->
    <link rel="icon" href="{{ url('storage/favicon.ico') }}" type="image/x-icon">

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="body">
    <div class="layout">
        <h1 class="visually-hidden">{{ config('app.name') }}</h1>
        <div class="sidebar">
            @include('layouts.sidebar')
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>