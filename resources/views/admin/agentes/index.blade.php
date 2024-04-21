<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="mt-3 max-w-7xl overflow-x-scroll rounded-lg bg-white px-5 py-5 shadow-xl shadow-yellow-900">
                <h1 class="m-3 rounded-full py-2 text-center text-lg text-slate-700">Lista de Usuários</h1>
                <table class="w-100" id="listas">
                    <thead class="bg-gradient-to-b from-gray-900 via-slate-500 to-slate-900">
                        <tr>
                            <th class="px-3 py-2 text-xs font-semibold text-slate-50">#</th>
                            <th class="px-3 py-2 text-xs font-semibold text-slate-50">Nome</th>
                            <th class="px-3 py-2 text-xs font-semibold text-slate-50">Email</th>
                            <th class="px-3 py-2 text-xs font-semibold text-slate-50">Data Nascimento</th>
                            <th class="px-3 py-2 text-xs font-semibold text-slate-50">Contato</th>
                            <th class="px-3 py-2 text-xs font-semibold text-slate-50">Banco</th>
                            <th class="px-3 py-2 text-xs font-semibold text-slate-50">Chave PIX</th>
                            <th class="px-3 py-2 text-xs font-semibold text-slate-50">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($agentes as $agente)
                            @if (!$agente->hasRole('super-admin'))
                                <tr class="odd:bg-slate-200">
                                    <td class="py-2 pl-2 text-xs">{{ $agente->id }}</td>
                                    <td class="py-2 pl-2 text-xs">{{ $agente->name }}</td>
                                    <td class="py-2 pl-2 text-xs">{{ $agente->email }}</td>
                                    <td class="py-2 pl-2 text-xs">
                                        @if (!is_null($agente->data_nascimento))
                                            {{ $agente->data_nascimento->format('d/m/Y') }}
                                        @else
                                            Não informado
                                        @endif
                                    </td>
                                    </td>
                                    <td class="py-2 pl-2 text-xs">{{ $agente->phone }}</td>
                                    <td class="py-2 pl-2 text-xs">{{ $agente->banco }}</td>
                                    <td class="py-2 pl-2 text-xs">{{ $agente->chave_pix }}</td>
                                    <td class="py-3 pl-2 text-xs">
                                        <a href="{{ route('admin.agentes.perfil', $agente) }}"
                                            class="text-nowrap rounded-full bg-blue-500 p-2 text-xs text-slate-50 hover:bg-blue-900">Acessar
                                            Perfil</a>
                                    </td>
                                </tr>
                            @endif
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-midas-layout>
