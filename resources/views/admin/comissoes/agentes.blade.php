<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>


    <div class="mx-auto w-full">
        <div class="flex flex-col rounded-lg bg-white p-10 shadow-sm">
            <div class="flex flex-col p-4 text-gray-900">
                <div class="flex h-10 flex-row items-center justify-between">
                    <form method="post" action="{{ route('admin.comissoes.operador') }}">
                        @csrf
                        <label for="month" class="mr-3 font-semibold">Filtros:</label>
                        <select name="month" id="month" class="mt-2 rounded-lg border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                            @foreach ($months as $key => $month)
                                <option value="{{ $key }}" @if ($key === $mesAtual) selected @endif>{{ $month }}</option>
                            @endforeach
                        </select>
                        <select name="user_id" id="user_id" class="mt-2 rounded-lg border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                            <option value="*">Selecione agente</option>
                            @foreach ($users as $ag)
                                @if (!$$ag->tipo)
                                    <option value="{{ $ag->id }}">{{ $ag->name }}</option>
                                @endif
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
            </div>
            <div class="flex w-full flex-col justify-center overflow-x-scroll">
                <table id="table_export" class="table-responsive table-sm text-nowrap">
                    <thead>
                        <tr class="bg-gradient-to-b from-slate-800 via-slate-700 to-indigo-800 font-bold text-slate-100">
                            <th class="text-xs font-semibold text-white">Lançamento</th>
                            <th class="text-xs font-semibold text-white">Pagamento</th>
                            <th class="text-xs font-semibold text-white">Cliente</th>
                            <th class="text-xs font-semibold text-white">Produto</th>
                            <th class="text-xs font-semibold text-white">Total</th>
                            <th class="text-xs font-semibold text-white">Líquido</th>
                            <th class="text-xs font-semibold text-white">% Agente</th>
                            <th class="text-xs font-semibold text-white">Val. Agente</th>
                            <th class="text-xs font-semibold text-white">Agente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comissoes as $tax)
                            <tr class="odd:bg-stone-100">
                                <td class="text-xs font-semibold capitalize">{{ !is_null($tax->proposta) ? $tax->proposta->data_digitacao->format('d/m/y') : 'Não informado' }}</td>
                                <td class="text-xs font-semibold capitalize">{{ is_null($tax->proposta) ? $tax->proposta->data_pagamento->format('d/m/y') : 'Não informado' }} </td>
                                <td class="text-xs font-semibold capitalize">{{ $tax->proposta->cliente->nome }}</td>
                                <td class="text-xs font-semibold capitalize">{{ $tax->proposta->produto->descricao_produto }}</td>
                                <td class="text-xs font-semibold capitalize">{{ $fmt->toCurrencyBRL($tax->proposta->total_proposta) }}</td>
                                <td class="text-xs font-semibold capitalize">{{ $fmt->toCurrencyBRL($tax->proposta->liquido_proposta) }}</td>
                                <td class="text-xs font-semibold capitalize">{{ $fmt->toPercentage($tax->percentual_agente, 2, 2) }}</td>
                                <td class="text-xs font-semibold capitalize">{{ $fmt->toCurrencyBRL($tax->valor_agente, 'BRL', 'pt_BR') }}</td>
                                <td class="overflow-hidden text-clip text-xs font-semibold capitalize">{{ $tax->proposta->user->name }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="font-italic bg-slate-100 text-xs font-bold">
                            <td colspan="4"></td>
                            <td>{{ $soma_total }}</td>
                            <td>{{ $soma_liquido }}</td>
                            <td></td>
                            <td>{{ $soma_agente }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="bg-white px-3 py-6 shadow-sm sm:rounded-lg">
        <div class="flex w-auto flex-row items-center justify-center gap-3 text-xs">
            <table class="w-75 rounded-lg border">
                <thead class="bg-gradient-to-br from-slate-900 to-indigo-700 p-2 text-center text-sm text-slate-50">
                    <tr>
                        <th class="p-2">Total Propostas</th>
                        <th class="p-2">Líquido Propostas</th>
                        <th class="p-2">Comissão Agente</th>
                    </tr>
                </thead>
                <tbody class="text-center text-sm font-semibold">
                    <tr>
                        <td class="bg-green-400 p-2 font-semibold text-slate-800">{{ $soma_total }}</td>
                        <td class="bg-sky-400 p-2 font-semibold text-slate-800">{{ $soma_liquido }}</td>
                        <td class="bg-yellow-500 p-2 font-bold text-slate-800">{{ $soma_agente }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-midas-layout>
