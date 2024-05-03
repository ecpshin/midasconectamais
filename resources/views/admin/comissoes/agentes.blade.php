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
                                @if ($ag->roles[0]->name != 'super-admin')
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
            <div class="flex flex-col justify-center overflow-x-scroll">
                <table id="tabela" class="table-responsive table-sm text-nowrap">
                    <thead class="bg-gradient-to-b from-slate-800 via-slate-700 to-indigo-800 font-bold text-slate-100">
                        <tr>
                            <th class="text-xs font-semibold text-white">ID</th>
                            <th class="text-xs font-semibold text-white">Lançamento</th>
                            <th class="text-xs font-semibold text-white">Pagamento</th>
                            <th class="text-xs font-semibold text-white">Cliente</th>
                            <th class="text-xs font-semibold text-white">Produto</th>
                            <th class="text-xs font-semibold text-white">Total</th>
                            <th class="text-xs font-semibold text-white">Líquido</th>
                            <th class="text-xs font-semibold text-white">% Agente</th>
                            <th class="text-xs font-semibold text-white">Val. Agente</th>
                            <th class="text-xs font-semibold text-white">Agente</th>
                            <th class="text-xs font-semibold text-white"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comissoes ?? [] as $tax)
                            <tr class="odd:bg-stone-100">
                                <td class="text-xs font-semibold">{{ $tax->id }}</td>
                                <td class="text-xs font-semibold capitalize">{{ $tax->proposta->data_digitacao->format('d/m/y') }}</td>
                                <td class="text-xs font-semibold capitalize">{{ $tax->proposta->data_pagamento->format('d/m/y') }} </td>
                                <td class="text-xs font-semibold capitalize">{{ $tax->proposta->cliente->nome }}</td>
                                <td class="text-xs font-semibold capitalize">{{ $tax->proposta->produto->descricao_produto }}</td>
                                <td class="text-xs font-semibold capitalize">
                                    {{ $fmt->currency($tax->proposta->total_proposta, 'BRL', 'pt_BR') }}
                                </td>
                                <td class="text-xs font-semibold capitalize">
                                    {{ $fmt->currency($tax->proposta->liquido_proposta, 'BRL', 'pt_BR') }}
                                </td>
                                <td class="text-xs font-semibold capitalize">
                                    {{ $fmt->percentage($tax->percentual_agente, 2) }}
                                </td>
                                <td class="text-xs font-semibold capitalize">
                                    {{ $fmt->currency($tax->valor_agente, 'BRL', 'pt_BR') }}
                                </td>
                                <td class="overflow-hidden text-clip text-xs font-semibold capitalize">{{ $tax->proposta->user->name }}</td>
                                <td class="flex items-center">
                                    <a href="{{ route('admin.comissoes.show', $tax) }}" class="rounded-sm bg-sky-800 px-2 py-2 shadow-md shadow-slate-500 hover:bg-sky-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50 hover:text-slate-50" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.comissoes.edit', $tax) }}" class="rounded-sm bg-yellow-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036h6v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="rounded-sm bg-red-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-red-900"
                                        onclick="document.getElementById('form_{{ $tax->id }}').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.comissoes.destroy', $tax) }}" method="post" id="form_{{ $tax->id }}">@csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
