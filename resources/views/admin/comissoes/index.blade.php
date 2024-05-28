<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <div class="flex h-10 flex-row items-center justify-between">

                        <form method="post" action="{{ route('admin.comissoes.index') }}">
                            @csrf
                            <label for="month" class="mr-3 font-semibold">Filtrar:</label>
                            <select name="month" id="month" class="mt-2 rounded-lg border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @foreach ($months as $key => $month)
                                    <option value="{{ $key }}" @if ($key === $mesAtual) selected @endif>{{ $month }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="rounded-lg bg-emerald-700 px-3 py-2 text-xs text-white hover:bg-emerald-600">Carregar</button>
                        </form>
                        <span class="text-lg">Movimento do mês:
                            @isset($mesAtual)
                                {{ $mesAtual . '/' . date('Y') }}
                            @endisset
                        </span>
                    </div>
                    <div class="mb-5 flex flex-col overflow-x-scroll rounded-lg bg-white px-3 py-6">
                        <table class="table-responsive table-sm" id="table_export">
                            <thead class="bg-black font-bold text-slate-100">
                                <tr>
                                    <th class="text-xs font-semibold text-white">Nº Contrato</th>
                                    <th class="text-xs font-semibold text-white">Lançamento</th>
                                    <th class="text-xs font-semibold text-white">Pagamento</th>
                                    <th class="text-xs font-semibold text-white">Cliente</th>
                                    <th class="text-xs font-semibold text-white">Operação</th>
                                    <th class="text-xs font-semibold text-white">Total</th>
                                    <th class="text-xs font-semibold text-white">Líquido</th>
                                    <th class="text-xs font-semibold text-white">Val. Loja</th>
                                    <th class="text-xs font-semibold text-white">Val. Agente</th>
                                    <th class="text-xs font-semibold text-white">Val. Corretor</th>
                                    <th class="text-xs font-semibold text-white">Agente</th>
                                    <th class="text-xs font-semibold text-white"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comissoes as $com)
                                    <tr class="odd:bg-fuchsia-100">
                                        <td class="text-xs font-semibold capitalize">{{ $com->proposta->numero_contrato }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $fmt->toDate($com->proposta->data_digitacao) }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $fmt->toDate($com->proposta->data_pagamento) }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $com->proposta->cliente->nome }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $com->proposta->produto->descricao_produto }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $fmt->toCurrencyBRL($com->proposta->total_proposta) }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $fmt->toCurrencyBRL($com->proposta->liquido_proposta) }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $fmt->toCurrencyBRL($com->valor_loja) }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $fmt->toCurrencyBRL($com->valor_agente) }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $fmt->toCurrencyBRL($com->valor_corretor) }}</td>
                                        <td class="text-xs font-semibold capitalize">{{ $com->proposta->user->name }}</td>
                                        <td></td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="bg-slate-100 text-xs font-bold">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $soma_total }}</td>
                                    <td>{{ $soma_liquido }}</td>
                                    <td>{{ $soma_loja }}</td>
                                    <td>{{ $soma_agente }}</td>
                                    <td>{{ $soma_corretor }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto mb-3 mt-3 w-full text-xs sm:px-4 lg:px-6">
            <div class="bg-white px-3 py-6 shadow-sm sm:rounded-lg">
                <div class="flex w-auto flex-row items-center justify-center gap-3 text-xs">
                    <table class="w-75 rounded-lg border">
                        <thead class="bg-gradient-to-br from-slate-900 to-indigo-700 p-2 text-center text-sm text-slate-50">
                            <tr>
                                <th class="p-2">Total Propostas</th>
                                <th class="p-2">Líquido Propostas</th>
                                @hasrole('super-admin')
                                    <th class="p-2">Comissão Loja</th>
                                @endhasrole
                                <th class="p-2">Comissão Agente</th>
                                <th class="p-2">Comissão Corretor</th>
                            </tr>
                        </thead>
                        <tbody class="text-center text-sm font-semibold">
                            <tr>
                                <td class="p-2">{{ $soma_total }}</td>
                                <td class="p-2">{{ $soma_liquido }}</td>
                                @hasrole('super-admin')
                                    <td class="bg-emerald-500 p-2 text-white">{{ $soma_loja }}</td>
                                @endhasrole
                                <td class="bg-yellow-500 p-2 text-slate-700">{{ $soma_agente }}</td>
                                <td class="bg-cyan-500 p-2 text-white">{{ $soma_corretor }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
