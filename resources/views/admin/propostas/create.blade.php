<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="mx-auto w-full sm:px-4 lg:px-6">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.propostas.store') }}" method="post">
                @csrf
                <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados da Proposta</h5>
                <div class="flex flex-col gap-4 p-3 text-indigo-700">
                    <fieldset class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="flex flex-col gap-4 p-3 text-indigo-700">
                            <div class="row flex flex-row text-xs">
                                <div class="col-lg-2 mb-3 flex flex-col">
                                    <label class="form-label">
                                        <button type="button" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-search"></i> ID</button>
                                    </label>
                                    <input type="text" name="cliente_id" id="cliente_id" class="form-input rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="col-lg-8 mb-3 flex flex-col">
                                    <label class="form-label">Nome</label>
                                    <input type="text" id="nome_cliente" class="form-input rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="col-lg-2 mb-3 flex flex-col">
                                    <label class="form-label">CPF</label>
                                    <input type="text" id="cpf_cliente" value="" class="form-input rounded-lg border-gray-300 text-xs">
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 p-3 text-indigo-700">
                            <div class="row flex flex-row justify-between text-xs">
                                <div class="col-lg-2 flex flex-col">
                                    <label for="uuid" class="form-label">Controle</label>
                                    <input type="text" name="uuid" id="uuid" value="{{ old('uuid', $uuid) }}"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs" readonly="true">
                                </div>
                                <div class="col-lg-2 flex flex-col">
                                    <label for="numero_contrato" class="form-label">Nº Contrato</label>
                                    <input type="text" name="numero_contrato" id="numero_contrato" value="{{ old('numero_contrato') }}"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs" placeholder="Não informado">
                                </div>
                                <div class="col-lg-2 flex flex-col">
                                    <label for="data_digitacao" class="form-label">Digitado</label>
                                    <input type="date" name="data_digitacao" id="data_digitacao" value="{{ old('data_digitacao', date('Y-m-d')) }}"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-2 flex flex-col">
                                    <label for="data_pagamento" class="form-label">Pago</label>
                                    <input type="date" name="data_pagamento" id="data_pagamento" value="{{ old('data_pagamento', null) }}"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-4 flex flex-col">
                                    <label class="form-label text-xs">Agente|Corretor</label>
                                    <select name="user_id" id="user_id" class="form-select rounded-lg border text-xs">
                                        <option value="">Selecione...</option>
                                        <optgroup label="Agentes">
                                            @forelse ($agentes as $agente)
                                                <option value="{{ $agente->id }}" @if (Auth::user()->id == $agente->id) selected @endif>{{ $agente->name }}</option>
                                            @empty
                                                <option value="">Não há agentes</option>
                                            @endforelse
                                        </optgroup>
                                        <optgroup label="Corretores">
                                            @forelse ($corretores as $corretor)
                                                <option value="{{ $corretor->id }}" @if (Auth::user()->id == $corretor->id) selected @endif>
                                                    {{ $corretor->name }}</option>
                                            @empty
                                                <option value="">Não há Corretores</option>
                                            @endforelse
                                        </optgroup>

                                    </select>
                                </div>
                            </div>
                            <div class="row flex flex-row justify-between text-xs">
                                <div class="col-lg-3">{{-- Orgao  --}}
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Órgão</label>
                                        <select name="organizacao_id" id="organizacao_id" data-url="{{ route('api.tabelas', 0) }}" class="form-select rounded-lg border text-xs">
                                            <option value="0">Selecione o órgão</option>
                                            @forelse ($orgaos as $orgao)
                                                <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                            @empty
                                                Não há vínculos válidos
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">{{-- Produto --}}
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Produto</label>
                                        <select name="produto_id" id="produto_id" class="form-select rounded-lg border text-xs" data-url="{{ route('api.financeira', 0) }}">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">{{-- Financeira --}}
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Financeira</label>
                                        <select name="financeira_id" id="financeira_id" class="form-select rounded-lg border text-xs"
                                            data-url={{ route('api.correspondentes', 0) }}>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">{{-- Correspondente --}}
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Correspondente</label>
                                        <select name="correspondente_id" id="correspondente_id" class="form-select rounded-lg border text-xs"
                                            data-url={{ route('api.tabelas-comissoes', 0) }}>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">{{-- Tabela --}}
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Tabela</label>
                                        <select name="tabela_id" id="tabela_id" data-url="{{ route('api.tabela', 0) }}" class="form-select rounded-lg border text-xs">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex flex-row justify-between text-xs">
                                <div class="col-lg-2"><!-- Prazo -->
                                    <div class="form-group flex flex-col">
                                        <label for="prazo_proposta" class="form-label">Prazo</label>
                                        <input type="number" name="prazo_proposta" id="prazo_proposta" min="0" max="999" step="1"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="col-lg-2"><!-- Total -->
                                    <div class="form-group flex flex-col">
                                        <label for="total_proposta" class="form-label">Total</label>
                                        <input type="number" name="total_proposta" id="total_proposta" min="0.00" max="1000000.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="col-lg-2"><!-- Parcela -->
                                    <div class="form-group flex flex-col">
                                        <label for="parcela_proposta" class="form-label">Parcela</label>
                                        <input type="number" name="parcela_proposta" id="parcela_proposta" min="0.00" max="1000000.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="col-lg-2"><!-- Líquido -->
                                    <div class="form-group flex flex-col">
                                        <label for="liquido_proposta" class="form-label">Líquido</label>
                                        <input type="number" name="liquido_proposta" id="liquido_proposta" min="0.00" max="1000000.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs" onblur="calcularComissoes()">
                                    </div>
                                </div>
                                <div class="col-lg-2"><!-- Situação -->
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Situação</label>
                                        <select name="situacao_id" id="situacao_id" class="form-select rounded-lg border text-xs">
                                            <option value="0">Selecione situação</option>
                                            @foreach ($situacoes as $situacao)
                                                <option value="{{ $situacao->id }}">{{ strtoupper($situacao->descricao_situacao) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex flex-row justify-start text-xs">
                                <div class="{{ Auth::user()->hasRole('super-admin') ? 'col-lg-4 mb-3 flex flex-row' : 'hidden' }}">
                                    <div class="col-lg-5 flex flex-col text-xs">
                                        <label class="form-label">% Loja</label>
                                        <input type="number" name="percentual_loja" id="perc_loja" min="0.00" max="100.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                    <div class="col-lg-7 flex flex-col text-xs">
                                        <label class="form-label">R$</label>
                                        <input type="number" name="valor_loja" id="val_loja" min="0.00" max="1000000.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="{{ Auth::user()->hasRole('super-admin') || Auth::user()->tipo != 'corretor' ? 'col-lg-4 mb-3 flex flex-row' : 'hidden' }}">
                                    <div class="col-lg-5 flex flex-col text-xs">
                                        <label class="form-label">% Agente</label>
                                        <input type="number" name="percentual_agente" id="perc_agente" min="0.00" max="100.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                    <div class="col-lg-7 flex flex-col text-xs">
                                        <label class="form-label">R$</label>
                                        <input type="number" name="valor_agente" id="val_agente" min="0.00" max="1000000.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="{{ Auth::user()->hasRole('super-admin') || Auth::user()->tipo != 'agente' ? 'col-lg-4 mb-3 flex flex-row' : 'hidden' }}">
                                    <div class="col-lg-5 flex flex-col text-xs">
                                        <label class="form-label">% Corretor</label>
                                        <input type="number" name="percentual_corretor" id="perc_corretor" min="0.00" max="100.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                    <div class="col-lg-7 flex flex-col">
                                        <label class="form-label">R$</label>
                                        <input type="number" name="valor_corretor" id="val_corretor" min="0.00" max="1000000.00" step="0.01"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div>
                        <button type="submit" class="rounded-lg bg-green-700 px-10 py-2 text-stone-50">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-teal-800 bg-gradient-to-br from-slate-900 via-indigo-700 to-slate-700">
                    <h5 class="modal-title w-100 text-center text-xl font-semibold text-teal-50" id="modalClientesLabel">Seleção de Cliente</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                                    <td class="px-3 py-2 text-left">
                                        <a role="button" id="cliente_{{ $cli->id }}" onclick="loadCliente('{{ $cli }}')" data-dismiss="modal"
                                            class="h-5 w-5 rounded-full bg-yellow-300 px-3 py-2 font-bold">{{ $cli->id }}</a>
                                    </td>
                                    <td class="px-3 py-2 text-left">{{ $cli->nome }}</td>
                                    <td class="px-3 py-2 text-left">{{ $cli->cpf }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</x-midas-layout>
