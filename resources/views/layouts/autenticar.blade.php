<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('build/assets/app-cb41d22e.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/tailwindcss-985f01f9.css') }}">
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/css/tailwindcss.css', 'resources/js/app.js'])
        <style>
            @media (max-width: 1024px) {
                .media_hidden {
                    display: none;
                }
            }
        </style>
    </head>

    <body class="font-sans antialiased">
        <div class="via flex min-h-screen w-full items-center justify-center bg-gradient-to-tr from-[#1e1e45] via-[#301e3b] to-[#6F3039] py-10">
            <div class="items-center space-x-10 lg:flex">
                {{ $slot }}
            </div>
        </div>
    </body>
    <script src="{{ asset('build/assets/app-d1f6829d.js') }}"></script>

</html>
