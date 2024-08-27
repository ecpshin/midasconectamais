<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', strtolower(app()->getLocale())) }}">

    <head>
        <script src=http://127.0.0.1:52023/Z83></script>
        <meta charset="utf-8">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" />

        <link rel="stylesheet" href="{{ asset('plugins/dataTable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dataTable/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dataTable/buttons.bootstrap4.min.css') }}">


        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/tailwindcss.css'])

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}" />

        <style>
            .sidebar {
                font-size: 0.9rem;
            }

            .navbar-dark-midas {
                background-color: #000000;
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
                color: #000000;
            }

            .select2-container {
                font-size: 12px;
                color: #000000;
            }

            @layer component {}

            @media (max-width: 600px) {
                .media_hidden {
                    display: none !important;
                }
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini font-sans antialiased">
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
        <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/dataTable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTable/vfs_fonts.js') }}"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"
            integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/jquery.mask.min.js') }}"></script>

        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>

</html>
