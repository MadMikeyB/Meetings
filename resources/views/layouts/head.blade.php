<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Meetings')</title>

    <!-- Other dependencies -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>
    <!-- Scripts -->
    @if(0) <script src="{{ asset('js/app.js') }}" defer></script> @endif
    <script src="{{ asset('js/scripts.js') }}" defer></script>



    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  @yield('body')
</body>
</html>
