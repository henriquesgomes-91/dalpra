<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/adminlte.min.css','resources/css/app.css', 'resources/sass/custom.scss'])
    <style>
        .fixed {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 2.5rem;
            text-align: center;
        }
    </style>
</head>
<body class="login-page">
@yield('content')
<footer class="fixed">Powered by <a href="http://aikos.com.br/" target="_blank">Aikos Desenvolvimento de Sistemas e Soluções em TI</a> </footer>
</body>
</html>
