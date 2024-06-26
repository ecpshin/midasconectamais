<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="mb-5 mt-3 max-w-7xl overflow-x-scroll rounded-lg bg-white px-5 py-3 shadow-md shadow-slate-900">
                <div class="mb-3 mt-3 w-full">
                    <a href="{{ route('admin.agentes.create') }}" class="rounded-full bg-gradient-to-br from-green-800 to-green-700 px-4 py-1.5 text-sm text-slate-50">Novo</a>
                </div>
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
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-midas-layout>
