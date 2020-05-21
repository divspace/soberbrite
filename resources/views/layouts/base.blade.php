<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @hasSection('title')
            <title>@yield('title') | {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <link href="https://rsms.me/inter/inter.css" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        @livewireStyles
    </head>

    <body>
        @yield('body')

        <script src="{{ mix('js/app.js') }}"></script>

        @livewireScripts
    </body>
</html>
