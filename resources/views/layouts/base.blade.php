<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @hasSection('title')
            <title>@yield('title') | {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        @yield('body')

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
