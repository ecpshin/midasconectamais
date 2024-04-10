<aside :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="custom-scrollbar fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto bg-rose-950 transition duration-300 lg:inset-0 lg:translate-x-0">

    <div class="flex h-16 items-center justify-center bg-rose-950">
        <h1 class="text-lg font-bold uppercase tracking-widest text-slate-100">
            MIDAS CONECTA+
        </h1>
    </div>

    <nav class="custom-scrollbar bg-rose-950">
        <div x-data="{ linkHover: false, linkActive: false }">
            <p class="text-md mb-2 mt-3 flex flex-row gap-3 px-6 text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition duration-200" :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </p>
        </div>
        <div x-data="{ linkHover: false, linkActive: false }">
            <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                class="flex cursor-pointer items-center justify-between px-6 py-3 text-rose-200 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100"
                :class="linkActive ? 'bg-rose-500 bg-opacity-30 text-white' : ''">
                <div class="flex items-center">
                    <i class="bi bi-gear"></i>
                    <span class="ml-3">Clientes</span>
                </div>
                <svg class="h-3 w-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
            <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-rose-200">
                <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-300 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                    <a href="{{ route('admin.clientes.index') }}" class="flex items-center">
                        <i class="bi bi-people-fill"></i>
                        <span class="ml-2 overflow-ellipsis">Lista</span>
                    </a>
                </li>
                <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-300 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                    <a href="{{ route('admin.clientes.create') }}" class="flex items-center">
                        <i class="bi bi-people-fill"></i>
                        <span class="ml-2 overflow-ellipsis">Novo</span>
                    </a>
                </li>
            </ul>
        </div>
        <div x-data="{ linkHover: false, linkActive: false }">
            <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                class="flex cursor-pointer items-center justify-between px-6 py-3 text-rose-200 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100"
                :class="linkActive ? 'bg-rose-500 bg-opacity-30 text-gray-100' : ''">
                <div class="flex items-center">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <span class="ml-3">Propostas</span>
                </div>
                <svg class="h-3 w-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
            <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-rose-200">
                <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                    <a href="{{ route('admin.propostas.index') }}" class="flex items-center">
                        <i class="bi bi-card-list"></i>
                        <span class="ml-2 overflow-ellipsis">Listar Propostas</span>
                    </a>
                </li>
                <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                    <a href="{{ route('admin.propostas.create') }}" class="flex items-center">
                        <i class="bi bi-cash-coin"></i>
                        <span class="ml-2 overflow-ellipsis">Nova Proposta</span>
                    </a>
                </li>
                <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                    <a href="{{ route('admin.propostas.filtrar-por-data') }}" class="flex items-center">
                        <i class="bi bi-search"></i>
                        <span class="ml-2 overflow-ellipsis">Filtrar</span>
                    </a>
                </li>
            </ul>
        </div>
        <div x-data="{ linkHover: false, linkActive: false }">
            <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                class="flex cursor-pointer items-center justify-between px-6 py-3 text-rose-200 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100"
                :class="linkActive ? 'bg-rose-500 bg-opacity-30 text-gray-100' : ''">
                <div class="flex items-center">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <span class="ml-3">Mailings</span>
                </div>
                <svg class="h-3 w-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
            <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-rose-200">
                <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                    <a href="{{ route('admin.mailings.index') }}" class="flex items-center">
                        <i class="bi bi-card-list"></i>
                        <span class="ml-2 overflow-ellipsis">Lista</span>
                    </a>
                </li>
                <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                    <a href="{{ route('admin.mailings.create') }}" class="flex items-center">
                        <i class="bi bi-cash-coin"></i>
                        <span class="ml-2 overflow-ellipsis">Carregar Lista</span>
                    </a>
                </li>
            </ul>
        </div>
        @hasrole('super-admin')
            <div x-data="{ linkHover: false, linkActive: false }">
                <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                    class="flex cursor-pointer items-center justify-between px-6 py-3 text-rose-200 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100"
                    :class="linkActive ? 'bg-rose-500 bg-opacity-30 text-gray-100' : ''">
                    <div class="flex items-center">
                        <i class="bi bi-people"></i>
                        <span class="ml-3">Usuários</span>
                    </div>
                    <svg class="h-3 w-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-rose-200">
                    <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                        <a href="{{ route('admin.agentes.index') }}" class="flex items-center">
                            <i class="bi bi-person-lines-fill"></i>
                            <span class="ml-2 overflow-ellipsis">Todos</span>
                        </a>
                    </li>
                    @can('create user')
                        <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                            <a href="{{ route('admin.agentes.create') }}" class="flex items-center">
                                <i class="bi bi-person-lines-fill"></i>
                                <span class="ml-2 overflow-ellipsis">Registrar</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
            <div x-data="{ linkHover: false, linkActive: false }">
                <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                    class="flex cursor-pointer items-center justify-between px-6 py-3 text-rose-200 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100"
                    :class="linkActive ? 'bg-rose-500 bg-opacity-30 text-gray-100' : ''">
                    <div class="flex items-center">
                        <i class="bi bi-cash-stack"></i>
                        <span class="ml-3">Comissionamento</span>
                    </div>
                    <svg class="h-3 w-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-rose-200">
                    <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                        <a href="{{ route('admin.comissoes.index') }}" class="flex items-center">
                            <i class="bi bi-cash-stack mr-3"></i>
                            <span class="overflow-ellipsis">Geral</span>
                        </a>
                    </li>
                    <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                        <a href="{{ route('admin.comissoes.ajustar') }}" class="flex items-center">
                            <i class="bi bi-cash-stack mr-3"></i>
                            <span class="overflow-ellipsis">Ajustar</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div x-data="{ linkHover: false, linkActive: false }">
                <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                    class="flex cursor-pointer items-center justify-between px-6 py-3 text-rose-200 transition duration-300 hover:bg-rose-500 hover:bg-opacity-40 hover:text-gray-100"
                    :class="linkActive ? 'bg-rose-500 bg-opacity-50 text-slate-100' : ''">
                    <div class="flex items-center">
                        <i class="bi bi-database"></i>
                        <span class="ml-3">Tabelas Secundárias</span>
                    </div>
                    <svg class="h-3 w-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-rose-200">
                    <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                        <a href="{{ route('admin.correspondentes.index') }}" class="flex items-center">
                            <span class="mr-2 text-sm"><i class="bi bi-buildings"></i></span>
                            <span class="overflow-ellipsis">Correspondentes</span>
                        </a>
                    </li>
                    <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                        <a href="{{ route('admin.financeiras.index') }}" class="flex items-center">
                            <span class="mr-2 text-sm"><i class="bi bi-bank2"></i></span>
                            <span class="overflow-ellipsis">Financeiras</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div x-data="{ linkHover: false, linkActive: false }">
                <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                    class="flex cursor-pointer items-center justify-between px-6 py-3 text-rose-200 transition duration-300 hover:bg-rose-500 hover:bg-opacity-40 hover:text-gray-100"
                    :class="linkActive ? 'bg-rose-500 bg-opacity-50 text-slate-100' : ''">
                    <div class="flex items-center">
                        <i class="bi bi-database"></i>
                        <span class="ml-3">Tabelas Auxiliares</span>
                    </div>
                    <svg class="h-3 w-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-rose-200">
                    <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                        <a href="{{ route('admin.organizacoes.index') }}" class="flex items-center">
                            <span class="mr-2 text-sm"><i class="bi bi-buildings"></i></span>
                            <span class="overflow-ellipsis">Órgãos</span>
                        </a>
                    </li>
                    <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                        <a href="{{ route('admin.operacoes.index') }}" class="flex items-center">
                            <span class="mr-2 text-sm"><i class="bi bi-hdd-stack"></i></span>
                            <span class="overflow-ellipsis">Operações</span>
                        </a>
                    </li>
                    <li class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-rose-500 hover:bg-opacity-30 hover:text-gray-100">
                        <a href="{{ route('admin.situacoes.index') }}" class="flex items-center">
                            <span class="mr-2 text-sm"><i class="bi bi-layers"></i></span>
                            <span class="overflow-ellipsis">Situações</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endhasrole
    </nav>
</aside>
