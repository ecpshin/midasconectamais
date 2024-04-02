<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto mt-8 w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white px-5 py-8 shadow-sm sm:rounded-lg">
                <div class="px-4 py-8 text-gray-900">
                    <!-- start::Advance Table Manage Icons -->
                    <a href="{{ route('admin.propostas.create') }}" class="text-md rounded-md bg-emerald-900 px-3 py-2 text-white shadow-md shadow-emerald-950 hover:bg-emerald-600">
                        <i class="bi bi-plus-circle"></i>
                        Lançar
                    </a>
                    <form action="{{ route('admin.propostas.producao-por-agente') }}" method="POST">
                        @csrf
                        <fieldset class="xs:flex-col mt-3 flex items-center gap-3 sm:flex-col lg:flex-row">
                            <select name="mes" class="w-100 form-select rounded-lg border-gray-300 lg:w-4/12" id="mes
                            ">
                                @foreach ($meses as $key => $mes)
                                    <option value="{{ $key }}" @if (date('m ', strtotime(now())) == $key) selected @endif>{{ $mes }}</option>
                                @endforeach
                            </select>
                            <select name="user_id" class="w-100 form-select rounded-lg border-gray-300 lg:w-4/12" id="user_id">
                                @foreach ($agentes as $agente)
                                    <option value="{{ $agente->id }}">{{ $agente->name }}</option>
                                @endforeach
                            </select>
                            <button tye="submit" class="rounded-md bg-sky-800 px-3 py-2 text-sm text-white shadow-md shadow-emerald-950 hover:bg-sky-500">
                                Visualizar
                            </button>
                        </fieldset>
                    </form>
                </div>
                <div class="overflow-x-scroll rounded-lg p-10">
                    <table class="table-auto" style="width: 90%;">
                        <thead class="bg-red-700 font-bold text-slate-100">
                            <tr>
                                <th class="px-3 py-2 text-xs font-semibold text-white">#</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Lançamento</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Pagamento</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Cliente</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Operação</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Total</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Parcela</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Líquido</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Financeira</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Correspondente</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Status</th>
                                <th class="px-3 py-2 text-xs font-semibold text-white">Agente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($propostas as $proposta)
                                <tr class="odd:bg-fuchsia-100">
                                    <td class="px-3 py-2 text-xs">
                                        {{ $proposta->id }}</td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $proposta->data_digitacao->format('d/m/y') }}
                                    </td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $proposta->data_pagamento->format('d/m/y') }}
                                    </td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $proposta->cliente->nome }}
                                    </td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $proposta->operacao->descricao_operacao }}
                                    </td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $fmt->currency($proposta->total_proposta, 'BRL', 'pt_BR') }}</td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $fmt->currency($proposta->parcela_proposta, 'BRL', 'pt_BR') }}</td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $fmt->currency($proposta->liquido_proposta, 'BRL', 'pt_BR') }}</td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $proposta->financeira->nome_financeira }}
                                    </td>
                                    <td class="px-3 py-2 text-xs capitalize">
                                        {{ $proposta->correspondente->nome_correspondente }}
                                    </td>
                                    <td class="text-xs font-bold capitalize">
                                        {{ $proposta->situacao->descricao_situacao }}
                                    </td>
                                    <td class="overflow-hidden text-clip px-3 py-2 text-xs capitalize">{{ $proposta->user->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13">Não há registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination flex flex-row justify-center">
                        @if (count($propostas) > 0)
                            {{ $propostas->links() }}
                        @endif
                    </div>
                </div>
                <div class="mt-8 flex flex-row items-center justify-center gap-3">
                    <div class="flex flex-col items-center gap-2 bg-teal-300 bg-gradient-to-b px-4 py-4">
                        <h1 class="text-sm font-bold text-gray-900">Total Propostas</h1>
                        <h3 class="text-sm font-semibold italic text-black">{{ $fmt->currency($total_propostas ?? 0, 'BRL', 'pt_BR') }}</h3>
                    </div>
                    <div class="flex flex-col items-center gap-2 bg-amber-300 bg-gradient-to-b px-4 py-4">
                        <h1 class="text-sm font-bold text-black">Líquido Propostas</h1>
                        <h3 class="text-sm font-semibold italic text-black">{{ $fmt->currency($liquido_propostas ?? 0, 'BRL', 'pt_BR') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
