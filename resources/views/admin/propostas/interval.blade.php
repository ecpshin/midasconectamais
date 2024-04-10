<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="w-full bg-white px-10 py-8 shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <!-- start::Advance Table Manage Icons -->
                    <a href="{{ route('admin.propostas.create') }}" class="text-md rounded-md bg-emerald-900 px-3 py-2 text-white shadow-md shadow-emerald-950 hover:bg-emerald-600">
                        <i class="bi bi-plus-circle"></i>
                        Lançar
                    </a>
                    <form action="{{ route('admin.propostas.aplicar_filtro_por_data') }}" method="POST">
                        @csrf
                        <fieldset class="mt-3 flex flex-row items-center">
                            <input type="date" name="inicio" id="inicio"
                                class="mr-2 rounded-lg border-gray-300 bg-white px-3 py-2 focus:border-gray-300 focus:outline-none focus:ring-0">
                            <input type="date" name="final" id="final"
                                class="mr-2 rounded-lg border-gray-300 bg-white px-3 py-2 focus:border-gray-300 focus:outline-none focus:ring-0">
                            <button tye="submit" class="rounded-md bg-sky-800 px-3 py-2 text-sm text-white shadow-md shadow-emerald-950 hover:bg-sky-500">
                                Novo Filtro
                            </button>
                        </fieldset>
                    </form>
                </div>
                <div class="mx-auto mb-5 overflow-x-auto bg-transparent" style="width: 100%;">
                    <table class="table-auto" width="100%" id="tabela">
                        <thead class="bg-red-700 font-bold text-slate-100">
                            <tr>
                                <th class="text-sm font-semibold text-white">ID</th>
                                <th class="text-sm font-semibold text-white">Lançamento</th>
                                <th class="text-sm font-semibold text-white">Pagamento</th>
                                <th class="text-sm font-semibold text-white">Cliente</th>
                                <th class="text-sm font-semibold text-white">Operação</th>
                                <th class="text-sm font-semibold text-white">Total</th>
                                <th class="text-sm font-semibold text-white">Parcela</th>
                                <th class="text-sm font-semibold text-white">Líquido</th>
                                <th class="text-sm font-semibold text-white">Financeira</th>
                                <th class="text-sm font-semibold text-white">Correspondente</th>
                                <th class="text-sm font-semibold text-white">Status</th>
                                <th class="text-sm font-semibold text-white">Agente</th>
                                <th class="text-sm font-semibold text-white"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($propostas as $proposta)
                                <tr class="odd:bg-fuchsia-100">
                                    <td class="text-nowrap px-2 py-3 text-sm">
                                        {{ $proposta->id }}</td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->data_digitacao->format('d/m/y') }}
                                    </td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->data_pagamento->format('d/m/y') }}
                                    </td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->cliente->nome }}
                                    </td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->operacao->descricao_operacao }}
                                    </td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->total_proposta }}</td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->parcela_proposta }}</td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->liquido_proposta }}</td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->financeira->nome_financeira }}
                                    </td>
                                    <td class="text-nowrap px-2 py-3 text-sm capitalize">
                                        {{ $proposta->correspondente->nome_correspondente }}
                                    </td>
                                    <td class="px-2 py-2 text-sm font-bold capitalize">
                                        {{ $proposta->situacao->descricao_situacao }}
                                    </td>
                                    <td class="text-nowrap overflow-hidden text-clip px-2 py-2 text-sm capitalize">{{ $proposta->user->name }}</td>
                                    <td class="flex items-center space-x-1 py-2">
                                        <a href="{{ route('admin.propostas.show', $proposta) }}" class="rounded-sm bg-sky-800 p-2 shadow-md shadow-slate-500 hover:bg-sky-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50 hover:text-slate-50" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.propostas.edit', $proposta) }}"
                                            class="rounded-sm bg-yellow-700 p-2 shadow-md shadow-slate-500 hover:bg-yellow-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <a href="#" class="rounded-sm bg-red-700 p-2 shadow-md shadow-slate-500 hover:bg-red-900"
                                            onclick="document.getElementById('form_{{ $proposta->id }}').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.propostas.destroy', $proposta) }}" method="post" id="form_{{ $proposta->id }}">@csrf @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13">Não há registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- end::Advance Table Manage Icons -->
            </div>
        </div>
    </div>
    </div>
</x-midas-layout>
