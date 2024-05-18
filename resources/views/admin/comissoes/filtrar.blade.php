<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <div class="flex h-10 flex-row items-center justify-between">
                        <form method="post" action="{{ route('admin.comissoes.agente') }}">
                            @csrf
                            <label for="month" class="mr-3 font-semibold">Filtros:</label>
                            <select name="month" id="month" class="mt-2 rounded-lg border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @foreach ($months as $key => $month)
                                    <option value="{{ $key }}" @if ($key === $mesAtual) selected @endif>{{ $month }}</option>
                                @endforeach
                            </select>
                            <select name="user_id" id="user_id" class="mt-2 rounded-lg border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="*">Selecione agente</option>
                                @foreach ($agentes as $agente)
                                    @if (!$agente->hasRole('super-admin'))
                                        <option value="{{ $agente->id }}">{{ $agente->name }}</option>
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
                    <div class="mb-5 flex flex-col overflow-x-scroll rounded-lg bg-transparent px-3 py-6">
                        <table class="table-responsive table-sm" id="tabela">
                            <thead class="bg-red-700 font-bold text-slate-100">
                                <tr>
                                    <th class="text-xs font-semibold text-white">ID</th>
                                    <th class="text-xs font-semibold text-white">Lançamento</th>
                                    <th class="text-xs font-semibold text-white">Pagamento</th>
                                    <th class="text-xs font-semibold text-white">Cliente</th>
                                    <th class="text-xs font-semibold text-white">Operação</th>
                                    <th class="text-xs font-semibold text-white">Total</th>
                                    <th class="text-xs font-semibold text-white">Líquido</th>
                                    <th class="text-xs font-semibold text-white">Parcela</th>
                                    <th class="text-xs font-semibold text-white">% Loja</th>
                                    <th class="text-xs font-semibold text-white">Val. Loja</th>
                                    <th class="text-xs font-semibold text-white">% Agente</th>
                                    <th class="text-xs font-semibold text-white">Val. Agente</th>
                                    <th class="text-xs font-semibold text-white">Agente</th>
                                    <th class="text-xs font-semibold text-white"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($propostas ?? [] as $tax)
                                    <tr class="odd:bg-fuchsia-100">
                                        <td class="text-xs font-semibold">
                                            {{ $tax->comissao->id }}</td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $tax->data_digitacao->format('d/m/y') }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $tax->data_pagamento->format('d/m/y') }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $tax->cliente->nome }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $tax->produto->descricao_produto }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $fmt->currency($tax->total_proposta, 'BRL', 'pt_BR') }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $fmt->currency($tax->liquido_proposta, 'BRL', 'pt_BR') }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $fmt->currency($tax->parcela_proposta, 'BRL', 'pt_BR') }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $fmt->percentage($tax->comissao->percentual_loja, 2) }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $fmt->currency($tax->comissao->valor_loja, 'BRL', 'pt_BR') }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $fmt->percentage($tax->comissao->percentual_agente, 2) }}
                                        </td>
                                        <td class="text-xs font-semibold capitalize">
                                            {{ $fmt->currency($tax->comissao->valor_agente, 'BRL', 'pt_BR') }}
                                        </td>
                                        <td class="overflow-hidden text-clip text-xs font-semibold capitalize">{{ $tax->user->name }}</td>
                                        <td class="flex items-center">
                                            <a href="{{ route('admin.comissoes.show', $tax) }}"
                                                class="rounded-sm bg-sky-800 px-2 py-2 shadow-md shadow-slate-500 hover:bg-sky-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50 hover:text-slate-50" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.comissoes.edit', $tax) }}"
                                                class="rounded-sm bg-yellow-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-yellow-500">
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
        </div>
        <div class="mx-auto mt-3 w-full sm:px-4 lg:px-6">
            <div class="bg-white px-3 py-6 shadow-sm sm:rounded-lg">
                <div class="flex w-auto flex-row items-center justify-center gap-3 text-xs">
                    <div class="flex flex-col gap-2 rounded-lg border bg-green-100 px-4 py-3 shadow-md">
                        <h6 class="text-center text-xs font-bold uppercase">Valor total propostas:</h6>
                        <p class="text-center font-semibold italic">{{ $total_propostas }}</p>
                    </div>
                    <div class="flex flex-col gap-2 rounded-lg border bg-sky-100 px-4 py-3 shadow-md">
                        <h6 class="text-center text-xs font-bold uppercase">Valor líquido propostas:</h6>
                        <p class="text-center font-semibold italic">{{ $total_liquido }}
                    </div>
                    <div class="flex flex-col gap-2 rounded-lg border bg-yellow-100 px-4 py-3 shadow-md">
                        <h6 class="text-center text-xs font-bold uppercase">Total comissão loja:</h6>
                        <p class="text-center font-semibold italic">{{ $total_loja }}</p>
                    </div>
                    <div class="flex flex-col gap-2 rounded-lg border bg-red-100 px-4 py-3 shadow-md">
                        <h6 class="text-center text-xs font-bold uppercase">Total comissão agentes:</h6>
                        <p class="text-center font-semibold italic">{{ $total_agente }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
