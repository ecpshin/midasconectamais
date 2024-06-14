<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light py-2">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link disabled">Contato</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-left">
                <!-- User image -->
                <li class="flex flex-col items-center bg-gradient-to-br from-slate-800 to-orange-700 px-5 py-3">
                    <img src="{{ asset('storage/' . Auth::user()->path) }}" class="h-16 w-16 rounded-full" alt="User Image">
                    <p class="mt-3 text-[18px] text-slate-50">{{ Auth::user()->name }}</p>
                    <p class="text-[12px] text-slate-50">Desde {{ date('m/Y', strtotime(Auth::user()->created_at)) }}</p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                        <div class="col-4 text-center">
                        </div>
                        <div class="col-4 text-center">
                        </div>
                        <div class="col-4 text-center">
                        </div>
                    </div>
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('admin.agentes.perfil', Auth::user()) }}" class="btn btn-default btn-flat">Perfil</a>
                    <a href="#" class="btn btn-default btn-flat float-right" onclick="document.getElementById('form-logout').submit()">Sair</a>
                    <form action="{{ route('logout') }}" method="post" id="form-logout">@csrf</form>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
