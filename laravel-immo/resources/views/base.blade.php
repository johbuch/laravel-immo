<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lavarel immo</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('/js/app.js') }}"></script>

    </head>
    <body>
        @include('partials._header')
        @yield('content')
    </body>
</html>
