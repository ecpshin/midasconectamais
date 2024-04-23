<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.propostas.store') }}" method="post">
                @csrf
                <fieldset class="mb-3 flex gap-8 rounded bg-slate-100 px-6 py-6 shadow-sm shadow-slate-500">
                    <div class="flex w-1/12 flex-col gap-1">
                        <label class="text-sm font-semibold" data-bs-toggle="modal" data-bs-target="#modalClientes">
                            <i class="bi bi-person-check"></i> ID
                        </label>
                        <input type="text" name="cliente_id" readonly
                            class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="cliente_id">
                    </div>
                    <div class="flex w-2/12 flex-col gap-1">
                        <label class="text-sm font-semibold" for="cpf">CPF</label>
                        <input type="text" readonly class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                            id="cpf">
                    </div>
                    <div class="flex w-3/6 flex-col gap-1">
                        <label class="text-sm font-semibold" for="nome_cliente">Nome</label>
                        <input type="text" readonly class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0"
                            id="nome_cliente">
                    </div>
                </fieldset>
                <fieldset class="mb-3 flex flex-col gap-2 rounded-lg p-3 outline outline-1 outline-slate-500">
                    <h3 class="rounded-lg bg-gradient-to-b from-gray-900 to-gray-700 py-2 text-center text-lg text-slate-50">Dados da Proposta</h3>
                    <div class="row mx-3 flex justify-between px-3 pb-3">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500">Controle</label>
                            <input type="text" name="uuid" value="{{ $uuid }}" readonly
                                class="truncate rounded border-gray-300 bg-white py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="uuid">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="numero_contrato">Nº Contrato</label>
                            <input type="text" name="numero_contrato" onblur="fn(this)"
                                class="rounded border-gray-300 bg-white py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="numero_contrato">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="data_digitacao">Digitado</label>
                            <input type="date" name="data_digitacao"
                                class="flex-1 rounded-lg border-gray-300 bg-white py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="data_digitacao">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="data_pagamento">Pago</label>
                            <input type="date" name="data_pagamento"
                                class="flex-1 rounded-lg border-gray-300 bg-white py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="data_pagamento">
                        </div>
                    </div>
                    <div class="mx-3 flex flex-row px-3 pb-3">
                        <div class="col-lg-1 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="prazo">Prazo</label>
                            <input type="number" name="prazo_proposta" min="0" max="999" step="1"
                                class="rounded border-gray-300 bg-white py-1 text-right
                                focus:border-gray-300 focus:outline-none focus:ring-0" id="prazo">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="total_proposta">Total</label>
                            <input type="number" name="total_proposta" min="0.00" max="999999999.99" step="0.01"
                                class="valor rounded border-gray-300 bg-white py-1 text-right
                                focus:border-gray-300 focus:outline-none focus:ring-0" id="total_proposta">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="parcela_proposta">Parcela</label>
                            <input type="number" name="parcela_proposta" min="0.00" max="999999999.99" step="0.01"
                                class="valor rounded border-gray-300 bg-white py-1 text-right
                                focus:border-gray-300 focus:outline-none focus:ring-0" id="parcela_proposta">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="liquido_proposta">Líquido</label>
                            <input type="number" name="liquido_proposta" min="0.00" max="999999999.99" step="0.01"
                                class="valor rounded border-gray-300 bg-white py-1 text-right
                                    focus:border-gray-300 focus:outline-none focus:ring-0" id="liquido_proposta">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="operacao_id">Produtos</label>
                            <select name="produto_id" id="produto_id"
                                class="select2 rounded border-gray-300 py-1 text-sm text-black
                                    focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->descricao_produto }}</option>
                                @empty
                                    Não há Produtos
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="situacao_id">Situação</label>
                            <select name="situacao_id" id="situacao_id"
                                class="select2 rounded border-gray-300 py-1 text-base
                                    focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($situacoes as $situacao)
                                    <option value="{{ $situacao->id }}">{{ $situacao->descricao_situacao }}</option>
                                @empty
                                    <option value="">Não há situação cadastrada</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="financeira_id">Financeiras</label>
                            <select name="financeira_id" id="financeira_id" class="select2 border-gray-300 py-1 text-base
                                focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($financeiras as $fin)
                                    <option value="{{ $fin->id }}">{{ $fin->nome_financeira }}</option>
                                @empty
                                    <option>Não ha financeiras</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="correspondente_id">Correspondente</label>
                            <select name="correspondente_id" id="correspondente_id" onchange="carrega(this)"
                                class="select2 border-gray-300 py-1 text-base
                                    focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($correspondentes as $corr)
                                    <option value="{{ $corr->id }}" class="{{ $corr->percentual_comissao }}">
                                        {{ $corr->nome_correspondente }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 pb-3 border">
                        @can('create comissao')
                            <div class="col-lg-4 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500" for="tabela_id">Tabela</label>
                                <select name="tabela_id" id="tabela_id" data-url="{{ route('admin.tabelas.search', 0) }}"
                                    class="select2 select2-blue rounded border-gray-300 py-1 text-sm
                                        focus:border-gray-300 focus:outline-none focus:ring-0">
                                    @forelse ($tabelas as $tabela)
                                        <option value="{{ $tabela->id }}">{{ $tabela->descricao }}</option>
                                    @empty
                                        Não há Operações
                                    @endforelse
                                </select>
                            </div>
                    </div>
                    <div class="row mx-3" style="border: 1px solid #ccc;">
                        <div class="flex flex-col col-lg-4 gap-3 px-5 py-3">
                            <div class="flex flex-col ">
                                <label class="text-sm text-slate-500">% Loja</label>
                                <input type="number" name="percentual_loja" value="{{ old('percentual_loja', '000') }}" min="0.00" max="100.00" step="0.01"
                                    class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300
                                        focus:outline-none focus:ring-0" id="percentual_loja">
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm text-slate-500">Valor Loja</label>
                                <input type="number" name="valor_loja" value="{{ old('valor_loja', '000') }}" min="0.00" max="999999.99" step="0.01"
                                    class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300
                                        focus:outline-none focus:ring-0" id="valor_loja">
                            </div>
                        </div>
                        <div class="flex flex-col col-lg-4 gap-3 px-5 py-3">
                            <div class="flex flex-col">
                                <label class="text-sm text-slate-500">% Agente</label>
                                <input type="number" name="percentual_agente" value="{{ old('percentual_agente', '000') }}" min="0.00" max="100.00" step="0.01"
                                       class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300
                                       focus:outline-none focus:ring-0" id="percentual_agente">
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm text-slate-500">Valor Agente</label>
                                <input type="number" name="valor_agente" value="{{ old('valor_agente', '000') }}" min="0.00" max="999999.99" step="0.01"
                                       class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300
                                       focus:outline-none focus:ring-0" id="valor_agente">
                            </div>
                        </div>
                        <div class="flex flex-col col-lg-4 gap-3 px-5 py-3">
                            <div class="flex flex-col">
                                <label class="text-sm text-slate-500">% Corretor</label>
                                <input type="number" name="percentual_corretor"
                                       value="{{ old('percentual_corretor', '000') }}" min="0.00" max="100.00" step="0.01"
                                       class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300
                                       focus:outline-none focus:ring-0" id="percentual_corretor">
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm text-slate-500">Valor Corretor</label>
                                <input type="number" name="valor_corretor" value="{{ old('valor_corretor', '000') }}" min="0.00" max="999999.99" step="0.01"
                                    class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300
                                    focus:outline-none focus:ring-0" id="valor_corretor">
                            </div>
                        </div>
                    </div>
                    @endcan
                </fieldset>
                <div class="px-3 py-2">
                    <button type="submit"
                        class="rounded-lg bg-emerald-500 px-6 py-1.5 text-gray-100 transition duration-150 hover:bg-emerald-800 hover:text-slate-50 hover:shadow-xl">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="modalClientesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-teal-800">
                    <h1 class="w-100 text-center text-xl font-semibold text-teal-50" id="modalClientesLabel">Seleção de Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="removeItems()" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                </div>
                <div class="modal-body overflow-hidden overflow-y-auto px-16 py-10">
                    <table class="table-striped table text-sm" id="tabela" style="width: 100%;">
                        <thead class="bg-teal-300">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cli)
                                <tr class="even:bg-slate-300">
                                    <td class="px-3 py-2 text-left"><a href="#" onclick="loadCliente('{{ $cli }}')" data-bs-dismiss="modal"
                                            class="font-bold hover:text-blue-700">{{ $cli->id }}</a href="#"></td>
                                    <td class="px-3 py-2 text-left">{{ $cli->nome }}</td>
                                    <td class="px-3 py-2 text-left">{{ $cli->cpf }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" disabled class="rounded-lg bg-amber-400 px-3 py-2 text-gray-700 hover:bg-amber-600 hover:text-gray-50"
                        onclick="document.getElementById('form_modal').submit()">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
