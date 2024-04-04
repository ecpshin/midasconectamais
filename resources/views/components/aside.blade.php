<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-midas elevation-4 min-h-screen">
    <!-- Brand Logo -->
    <a href="#" class="brand-link flex flex-row items-center justify-center">
        <span class="brand-text font-sans text-yellow-600 antialiased">Midas Conecta</span>
        <img src="{{ asset('img/svg/node-plus.svg') }}" class="ml-2" alt="">
    </a>

    <!-- Sidebar -->
    <div class="sidebar sidebar-dark-midas">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-child-indent nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item mb-3 border-b border-slate-500 font-semibold">
                    <a class="nav-link">
                        <i class="nav-icon bi bi-boxes"></i>
                        <p class="text-md text-yellow-600">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                            Menu Principal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-child-indent">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                                    Clientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.clientes.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-person-fill-add"></i>
                                        <p class="font-semibold text-yellow-600 hover:text-yellow-500">Cadastrar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.clientes.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-people-fill"></i>
                                        <p class="font-semibold text-yellow-600 hover:text-yellow-500">Lista de Clientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="bi bi-list-check nav-icon items-center"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                                    Propostas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.propostas.index') }}" class="nav-link">
                                        <i class="bi bi-journal-plus nav-icon"></i>
                                        <p class="font-semibold text-yellow-600 hover:text-yellow-500">Lista de Propostas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.propostas.create') }}" class="nav-link">
                                        <i class="bi bi-plus-square nav-icon"></i>
                                        <p class="font-semibold text-yellow-600 hover:text-yellow-500">Cadastrar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.propostas.filtrar-por-data') }}" class="nav-link">
                                        <i class="bi bi-calendar-week nav-icon"></i>
                                        <p class="font-semibold text-yellow-600 hover:text-yellow-500">Resumo</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @hasrole(['super-admin'])
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="bi bi-cash-coin nav-icon"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                                        Comissões
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.propostas.index') }}" class="nav-link">
                                            <i class="bi bi-card-list nav-icon"></i>
                                            <p class="font-semibold text-yellow-600 hover:text-yellow-500">Relatório Mensal</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="bi bi-calendar3 nav-icon"></i>
                                            <p class="font-semibold text-yellow-600 hover:text-yellow-500">Relatório Agente</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.comissoes.index') }}" class="nav-link">
                                            <i class="bi bi-calendar3 nav-icon"></i>
                                            <p class="font-semibold text-yellow-600 hover:text-yellow-500">Geral</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.comissoes.ajustar') }}" class="nav-link">
                                            <i class="bi bi-calendar3 nav-icon"></i>
                                            <p class="font-semibold text-yellow-600 hover:text-yellow-500">Ajuste</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.tabelas.index') }}" class="nav-link">
                                            <i class="bi bi-calendar3 nav-icon"></i>
                                            <p class="font-semibold text-yellow-600 hover:text-yellow-500">Tabelas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endhasrole
                    </ul>
                </li>
                @hasrole(['super-admin'])
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi-database-fill-gear"></i>
                            <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                                Tabelas Secundárias
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.correspondentes.index') }}" class="nav-link">
                                    <i class="bi bi-building nav-icon"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-500">Correspondentes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.financeiras.index') }}" class="nav-link">
                                    <i class="bi bi-bank nav-icon"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-500">Financeiras</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                                Tabelas Auxiliares
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.organizacoes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-yellow-500"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-500">Organizações (Órgãos)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.situacoes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-blue-600"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-500">Situações</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.operacoes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-green-600"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-500">Operações</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                                Restrito
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.agentes.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-500">Registrar Usuário</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.agentes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-500">Usários Registrados</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endhasrole
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                            Mailings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.mailings.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-500">Mailings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.mailings.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-500">Carregar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-500">
                            Call Center
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.calls.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-500">Lista</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.mailings.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-500">Carregar</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- ./Main Sidebar Container -->
