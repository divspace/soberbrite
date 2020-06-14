<!doctype html>
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

    <body class="bg-white text-black">
        <nav>
            <div class="container mx-auto px-2 py-2">
                 <a class="font-bold text-2xl lg:text-4xl" href="{{ url('/') }}">
                     {{ config('app.name') }}
                 </a>
            </div>
        </nav>

        <div class="container mx-auto flex px-2 py-2">
            @yield('body')
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
