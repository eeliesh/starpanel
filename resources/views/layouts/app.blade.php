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
    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . config('app.css_version')) }}">
</head>
<body class="body">
    @if (session()->has('message'))
        <div class="toast {{ session()->get('message-type') }}">
            <div class="toast-content">
                <span class="material-icons">
                    {{ session()->get('message-type') == 'success' ? 'check' : 'close' }}
                </span>
                <div class="message">
                    <span class="text text-1">{{ ucfirst(session()->get('message-type')) }}</span>
                    <span class="text text-2">{{ session()->get('message') }}</span>
                </div>
            </div>
            <div class="progress"></div>
        </div>
    @endif

    <div class="layout">
        <h1 class="visually-hidden">{{ config('app.name') }}</h1>
        <div class="sidebar">
            @include('layouts.sidebar')
        </div>
        <div class="content">
            @yield('content')
        </div>
        <footer class="footer">
            <div class="copyright">
                <p>
                    Panel version: {{ config('app.app_version') }}
                </p>
                <p>
                    Based on Laravel Framework {{ app()->version() }}
                </p>
                <p>
                    Developed with a lot of
                    <span class="material-icons red">favorite</span>
                    and
                    <span class="material-icons blue">local_cafe</span>
                    by
                    <a href="https://www.instagram.com/iamiliesh/" target="_blank">
                        Valentin T.
                    </a>
                </p>
            </div>
        </footer>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js?v=' . config('app.css_version')) }}"></script>
</body>
</html>