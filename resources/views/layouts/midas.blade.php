<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/datatables.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/app-cb41d22e.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/tailwindcss-6bc83a36.css') }}">

        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/tailwindcss.css'])
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}" />

        <style>
            .sidebar {
                font-size: 12px;
            }

            .navbar-dark-midas {
                background-color: #6d0505;
            }

            .sidebar-dark-midas {
                background-color: #000000;
            }

            a.text-sm {
                font-size: 14px !important;
            }

            a.text-white {
                color: #fff !important;
            }

            a.rounded-lg {
                border-radius: 10px !important;
            }

            a.bg-green-500 {
                background-color: #298502;
            }

            a.rbg-green-500:hover {
                background-color: #133e00;
            }

            .select2 {
                font-size: 12px;
            }

            .select2-container {
                font-size: 12px;
            }


            @media (max-width: 600px) {
                .media_hidden {
                    display: none !important;
                }
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini bg-black font-sans antialiased">
        <x-preloader />

        <!-- wrapper -->
        <div class="wrapper">
            <x-navbar />

            <x-aside />

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                {{-- Breadcrumb --}}
                @if ($header)
                    <section class="w-full">
                        <header>
                            {{ $header }}
                        </header>
                    </section>
                @endif
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="d-none d-sm-block float-right">Desenvolvido por Francisco Shin <b>v</b>1.3.24</div>
                <strong>Copyright &copy; Since 2024
                    <a href="https://adminlte.io">Midas Conecta+</a>.</strong>
                Todos os direitos reservado.
            </footer>
        </div>
        <!-- ./wrapper -->
        @include('sweetalert::alert')
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
        <!-- Bootstrap 4 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/datatables.min.js"></script>
        <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>

</html>
