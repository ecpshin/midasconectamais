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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/datatables.min.css" rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/css/tailwind.css', 'resources/js/app.js'])

        <style>
            @media (max-width: 600px) {
                .media_hidden {
                    display: none !important;
                }
            }
        </style>
    </head>

    <body class="font-sans antialiased">
        <div x-data="{
            menuOpen: false,
            showModal: false
        }" class="custom-scrollbar flex min-h-screen">
            <!-- start::Black overlay -->
            <div :class="menuOpen ? 'block' : 'hidden'" @click="menuOpen = false" class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity"></div>
            <!-- end::Black overlay -->
            <x-sidebar />

            <div class="flex w-full flex-col lg:pl-64">
                @include('layouts.topbar')
                <!-- start:Page content -->
                <div class="relative h-full bg-slate-200 p-2">
                    {{ $slot }}
                </div>
                <!-- end:Page content -->
            </div>
        </div>
        @include('sweetalert::alert')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>

</html>
