<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <a href="{{ route('admin.propostas.create') }}"
                        class="flex h-[35px] w-[118px] flex-row items-center justify-center gap-2 rounded-md bg-emerald-900 py-2 text-white shadow-md shadow-emerald-950 hover:bg-emerald-600">
                        <i class="bi bi-plus-circle"></i>
                        Adicionar
                    </a>
                    <div class="my-3 flex flex-col overflow-x-scroll rounded-lg border bg-slate-50 px-3 py-6">
                        <table class="table-auto" id="tabela">
                            <thead class="bg-gradient-to-br from-slate-900 to-indigo-700 font-bold text-slate-100">
                                <tr>
                                    <th class="py-2 text-sm font-semibold text-white">ID</th>
                                    <th class="py-2 text-sm font-semibold text-white">Lançamento</th>
                                    <th class="py-2 text-sm font-semibold text-white">Pagamento</th>
                                    <th class="py-2 text-sm font-semibold text-white">Cliente</th>
                                    <th class="py-2 text-sm font-semibold text-white">Produto</th>
                                    <th class="py-2 text-sm font-semibold text-white">Prazo</th>
                                    <th class="py-2 text-sm font-semibold text-white">Total</th>
                                    <th class="py-2 text-sm font-semibold text-white">Parcela</th>
                                    <th class="py-2 text-sm font-semibold text-white">Líquido</th>
                                    <th class="py-2 text-sm font-semibold text-white">Financeira</th>
                                    <th class="py-2 text-sm font-semibold text-white">Correspondente</th>
                                    <th class="py-2 text-sm font-semibold text-white">Status</th>
                                    <th class="py-2 text-sm font-semibold text-white">Agente</th>
                                    <th class="py-2 text-sm font-semibold text-white"></th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                @foreach ($propostas as $proposta)
                                    <tr class="odd:bg-fuchsia-100">
                                        <td class="px-3 text-sm">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                                onclick="preencheModal('{{ $proposta }}',
                                                 '{{ $proposta->cliente }}',
                                                 '{{ $proposta->comissao }}')"
                                                class="px-2 py-1 text-blue-700 hover:rounded-full hover:bg-blue-700 hover:text-white">{{ $proposta->id }}</a>
                                        </td>
                                        <td class="px-3 text-sm">{{ $fmt->toDate($proposta->data_digitacao) }}</td>
                                        <td class="px-3 text-sm">{{ $fmt->toDate($proposta->data_pagamento) }}</td>
                                        <td class="px-3 text-sm capitalize">{{ $proposta->cliente->nome }}</td>
                                        <td class="px-3 text-sm capitalize">{{ $proposta->produto->descricao_produto }}</td>
                                        <td class="px-3 text-right text-sm">{{ $proposta->prazo_proposta }}</td>
                                        <td class="px-3 text-right text-sm">{{ $fmt->toCurrencyBRL($proposta->total_proposta) }}</td>
                                        <td class="px-3 text-right text-sm">{{ $fmt->toCurrencyBRL($proposta->parcela_proposta) }}</td>
                                        <td class="px-3 text-right text-sm">{{ $fmt->toCurrencyBRL($proposta->liquido_proposta) }}</td>
                                        <td class="px-3 text-sm capitalize">{{ $proposta->financeira->nome_financeira }}</td>
                                        <td class="px-3 text-sm capitalize">{{ $proposta->correspondente->nome_correspondente }}</td>
                                        <td class="px-3 text-sm capitalize">{{ $proposta->situacao->descricao_situacao }}</td>
                                        <td class="truncate px-3 text-sm font-semibold capitalize">{{ $proposta->user->name }}</td>
                                        <td class="flex items-center space-x-1 px-3">
                                            <a href="{{ route('admin.propostas.show', $proposta) }}"
                                                class="rounded-sm bg-sky-800 px-2 py-2 shadow-md shadow-slate-500 hover:bg-sky-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50 hover:text-slate-50" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.propostas.edit', $proposta) }}"
                                                class="rounded-sm bg-yellow-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-yellow-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <a href="#" class="rounded-sm bg-red-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-red-900"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" onclick="removeItems()" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-teal-800">
                    <h1 class="w-100 text-center text-xl font-semibold text-teal-50" id="modalEditLabel">Atualizar Proposta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="removeItems()" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form id="form_modal" action="" method="post" class="w-100 space-y-4 p-2">
                        @csrf @method('PATCH')
                        <div class="flex flex-row gap-2">
                            <div class="flex w-3/12 flex-col">
                                <label>Data Digitação</label>
                                <input type="date" tabindex="0"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" name="data_digitacao"
                                    id="digitacao" value="">
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Data pagamento</label>
                                <input type="date" class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                                    name="data_pagamento" id="pagamento" value="">
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Nº Controle</label>
                                <input type="text"
                                    class="flex-1 overflow-hidden text-ellipsis rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                                    name="uuid" id="uuids" value="">
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Nº Contrato</label>
                                <input type="text" class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                                    name="numero_contrato" id="nrcontrato" value="">
                            </div>
                        </div>
                        <div class="flex flex-row gap-2">
                            <div class="flex w-2/12 flex-col">
                                <label>ID Cliente</label>
                                <input type="text" class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                                    name="cliente_id" id="cliente_id" value="" disabled>
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>CPF</label>
                                <input type="text" class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                                    id="cpf" disabled>
                            </div>
                            <div class="flex w-7/12 flex-col">
                                <label>Nome Cliente</label>
                                <input type="text" class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                                    id="nome" disabled>
                            </div>
                        </div>
                        <div class="flex flex-row justify-between">
                            <div class="flex w-2/12 flex-col">
                                <label>Prazo</label>
                                <input type="number"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" step="1"
                                    name="prazo_proposta" id="prazo" value="0" min="0" placeholder="0">
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Total Proposta</label>
                                <input type="text"
                                    class="valor flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                    name="total_proposta" id="total" value="" placeholder="0,00">
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Parcela</label>
                                <input type="text"
                                    class="valor flex-1 text-ellipsis rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                    name="parcela_proposta" id="parcela" value="" placeholder="0,00" onblur="conversor(this)">
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Liquido Proposta</label>
                                <input type="text"
                                    class="valor flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                    name="liquido_proposta" id="liquido" value="" placeholder="0,00" onblur="conversor(this)">
                            </div>
                        </div>
                        {{-- Comissao --}}
                        @hasrole('super-admin')
                            <div class="flex flex-row justify-between">
                                <div class="flex w-2/12 flex-col">
                                    <label>Tabela</label>
                                    <input type="text"
                                        class="flex-1 overflow-hidden text-ellipsis rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                                        step="1" name="tabela_comissao" id="tabcom" value="" placeholder="Tabela">
                                </div>
                                <div class="flex w-2/12 flex-col">
                                    <label>% Loja</label>
                                    <input type="text"
                                        class="valor flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                        name="percentual_loja" id="percloja" value="" placeholder="0,00">
                                </div>
                                <div class="flex w-2/12 flex-col">
                                    <label>Val. Loja</label>
                                    <input type="text"
                                        class="valor flex-1 text-ellipsis rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                        name="valor_loja" id="valloja" value="" placeholder="0,00">
                                </div>
                                <div class="flex w-2/12 flex-col">
                                    <label>% Ag.</label>
                                    <input type="text"
                                        class="valor flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                        name="percentual_operador" id="percop" value="" placeholder="0,00" onblur="calculaComissao()">
                                </div>
                                <div class="flex w-2/12 flex-col">
                                    <label>Val. Agente</label>
                                    <input type="text"
                                        class="valor flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                        name="valor_operador" id="valop" value="" placeholder="0,00">
                                </div>
                            </div>
                        @endhasrole
                        {{-- selects --}}
                        <div class="flex flex-row gap-2">
                            <div class="flex w-3/12 flex-col">
                                <label>Operação</label>
                                <select name="operacao_id" id="op"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                    @forelse ($produtos as $produto)
                                        <option value="{{ $produto->id }}">{{ $produto->descricao_produto }}</option>
                                    @empty
                                        <option value="">Não há Produtos</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Financeiras</label>
                                <select name="financeira_id" id="fin"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                    @forelse ($financeiras as $fin)
                                        <option value="{{ $fin->id }}">{{ $fin->nome_financeira }}</option>
                                    @empty
                                        <option value="">Não há Financeiras</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Correspondente</label>
                                <select name="correspondente_id" id="corr"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                    @forelse ($correspondentes as $corr)
                                        <option value="{{ $corr->id }}">{{ $corr->nome_correspondente }}</option>
                                    @empty
                                        <option value="">Não há correspondentes</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="flex w-3/12 flex-col">
                                <label>Situação</label>
                                <select name="situacao_id" id="sitc"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                    @forelse ($situacoes as $sitc)
                                        <option value="{{ $sitc->id }}">{{ $sitc->descricao_situacao }}</option>
                                    @empty
                                        <option value="">Não há situação</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="rounded-lg bg-amber-400 px-3 py-2 text-gray-700 hover:bg-amber-600 hover:text-gray-50"
                        onclick="document.getElementById('form_modal').submit()">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
