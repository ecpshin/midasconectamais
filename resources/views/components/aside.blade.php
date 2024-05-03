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
                        <i class="nav-icon bi bi-boxes text-yellow-400"></i>
                        <p class="text-md text-lg text-yellow-600">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users nav-icon text-yellow-400"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-400">
                            Clientes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.clientes.create') }}" class="nav-link">
                                <i class="nav-icon bi bi-person-fill-add text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Cadastrar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.clientes.index') }}" class="nav-link">
                                <i class="fas fa-user nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Lista de Clientes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon text-yellow-400"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-400">
                            Propostas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.propostas.index') }}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Lista de Propostas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.propostas.create') }}" class="nav-link">
                                <i class="fas fa-plus-square nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Cadastrar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.propostas.filtrar-por-data') }}" class="nav-link">
                                <i class="fas fa-history nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Resumo</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-cash-coin nav-icon text-yellow-400"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-400">
                            Comissões
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.propostas.index') }}" class="nav-link">
                                <i class="fas fa-funnel-dollar nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Relatório Mensal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.comissoes.operadores') }}" class="nav-link">
                                <i class="fas fa-hand-holding-usd nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Comissões Agente</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.comissoes.corretores') }}" class="nav-link">
                                <i class="fas fa-hand-holding-usd nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Comissões Corretor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.comissoes.index') }}" class="nav-link">
                                <i class="fas fa-hand-holding-usd nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Geral</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                                <a href="{{ route('admin.comissoes.ajustar') }}" class="nav-link">
                                    <i class="bi bi-wrench-adjustable-circle nav-icon"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-400">Ajuste</p>
                                </a>
                            </li>
                            --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.tabelas.index') }}" class="nav-link">
                                <i class="fas fa-file-invoice-dollar nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Tabelas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users-cog nav-icon text-yellow-400"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-400">
                            Usuários
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.agentes.create') }}" class="nav-link">
                                <i class="fas fa-user-plus nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Novo Usuário</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.agentes.index') }}" class="nav-link">
                                <i class="fas fa-users nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Usários Registrados</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database text-yellow-400"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-400">
                            Tabelas Auxiliares
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.correspondentes.index') }}" class="nav-link">
                                <i class="fas fa-user-friends nav-icon text-yellow-600"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Correspondentes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.financeiras.index') }}" class="nav-link">
                                <i class="fas fa-landmark nav-icon text-yellow-600"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Financeiras</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.organizacoes.index') }}" class="nav-link">
                                <i class="fas fa-city nav-icon text-yellow-600"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Organizações (Órgãos)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.situacoes.index') }}" class="nav-link">
                                <i class="fas fa-exclamation-circle nav-icon text-yellow-600"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Situações</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.produtos.index') }}" class="nav-link">
                                <i class="fas fa-project-diagram nav-icon text-yellow-600"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Produtos</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-phone-volume nav-icon text-yellow-400"></i>
                        <p class="font-semibold text-yellow-600 hover:text-yellow-400">
                            Call Center
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @hasrole('super-admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.calls.gerenciar') }}" class="nav-link">
                                    <i class="fas fa-headset nav-icon text-yellow-400"></i>
                                    <p class="font-semibold text-yellow-600 hover:text-yellow-400">Gerenciar</p>
                                </a>
                            </li>
                        @endhasrole
                        <li class="nav-item">
                            <a href="{{ route('admin.calls.index') }}" class="nav-link">
                                <i class="fas fa-headset nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Geral</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.calls.prefeituras') }}" class="nav-link">
                                <i class="fas fa-headset nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Prefeituras</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.calls.governos') }}" class="nav-link">
                                <i class="fas fa-headset nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Governo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.calls.agendados') }}" class="nav-link">
                                <i class="fas fa-address-book nav-icon text-yellow-400"></i>
                                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Agendados</p>
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

{{-- <li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p class="font-semibold text-yellow-600 hover:text-yellow-400">
            Mailings
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.mailings.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Mailings</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.mailings.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="font-semibold text-yellow-600 hover:text-yellow-400">Carregar</p>
            </a>
        </li>
    </ul>
</li> --}}
