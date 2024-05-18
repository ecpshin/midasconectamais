<x-midas-layout>
    <x-slot name="header">
        <x-bread page="Testes" area="TESTES" rota="testes.index" />
    </x-slot>

    <div class="w-full">
        <form action="{{ route('admin.propostas.store') }}" method="post">
            @csrf
            <div class="mx-auto w-full sm:px-4 lg:px-6">
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-4 p-4 text-gray-700">
                        <h6>Cliente</h6>
                        @csrf
                        <div class="row flex flex-row text-xs">
                            <div class="col-8 flex flex-col">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" value="{{ strtoupper($cliente->nome) }}" id="nome" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-2 flex flex-col">
                                <label class="form-label">CPF</label>
                                <input type="text" name="cpf" value="{{ $cliente->cpf }}" id="cpf" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-2 flex flex-col">
                                <label class="form-label">Data Nasc.</label>
                                <input type="date" name="data_nascimento" value="{{ $cliente->data_nascimento->format('Y-m-d') }}" id="data_nascimento"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                        <div class="row flex flex-row text-xs">
                            <div class="col flex flex-col">
                                <label class="form-label">RG</label>
                                <input type="text" name="rg" value="{{ strtolower($cliente->rg) }}" id="rg" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label class="form-label">Org. Exp.</label>
                                <input type="text" name="orgao_exp" value="{{ strtoupper($cliente->orgao_exp) ?? 'SSP/RN' }}" id="orgao_exp"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label class="form-label">Data Exp.</label>
                                <input type="date" name="data_exp" value="{{ $cliente->data_exp->format('Y-m-d') }}" id="data_exp"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label class="form-label">Naturalidade</label>
                                <input type="text" name="naturalidade" value="{{ strtoupper($cliente->naturalidade) ?? 'Não informado' }}" id="naturalidade"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                        <div class="row flex flex-row text-xs">
                            <div class="col flex flex-col">
                                <label class="form-label">Genitora</label>
                                <input type="text" name="genitora" value="{{ strtoupper($cliente->genitora) ?? 'Não informado' }}" id="genitora"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label class="form-label">Genitor</label>
                                <input type="text" name="genitor" value="{{ strtoupper($cliente->genitor) ?? 'Não informado' }}" id="genitor"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label class="form-label">Sexo</label>
                                <input type="text" name="sexo" value="{{ strtoupper($cliente->sexo) ?? 'Não informado' }}" id="sexo"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label class="form-label">Estado Civil</label>
                                <input type="text" name="estado_civil" value="{{ strtoupper($cliente->estado_civil) ?? 'Não informado' }}" id="estado_civil"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Dados da Proposta --}}
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-4 p-4 text-gray-700">
                        <h4>Cadastrar Proposta</h4>
                        <div class="row flex flex-row text-xs">
                            <div class="col flex flex-col">
                                <label for="uuid" class="form-label">Controle</label>
                                <input type="text" name="uuid" id="uuid" value="{{ substr($uuid, 0, 18) }}" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label for="numero_contrato" class="form-label">Nº Contrato</label>
                                <input type="text" name="numero_contrato" id="numero_contrato" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label for="data_digitacao" class="form-label">Digitado</label>
                                <input type="date" name="data_digitacao" id="data_digitacao" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col flex flex-col">
                                <label for="data_pagamento" class="form-label">Pago</label>
                                <input type="date" name="data_pagamento" id="data_pagamento" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                        <div class="row flex flex-row text-xs">
                            <div class="col-3">
                                <div class="form-group flex flex-col">
                                    <label class="form-label text-xs">Órgão</label>
                                    <select name="organizacao_id" id="organizacao_id" data-url="{{ route('api.tabelas', 0) }}" onchange="teste(this)"
                                        class="form-select rounded-lg border text-xs">
                                        <option value="">Selecione o órgão</option>
                                        @foreach ($cliente->vinculos as $vinculo)
                                            <option value="{{ $vinculo->organizacao->id }}">{{ $vinculo->organizacao->nome_organizacao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group flex flex-col">
                                    <label class="form-label text-xs">Tabela</label>
                                    <select name="tabela_id" id="tabela_id" data-url="{{ route('api.tabela', 0) }}" class="form-select rounded-lg border text-xs">
                                        <option value="0">Selecione a tabela</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group flex flex-col">
                                    <label class="form-label text-xs">Financeira</label>
                                    <select name="financeira_id" id="financeira_id" class="form-select rounded-lg border text-xs">
                                        <option value="0">Selecione a tabela</option>
                                        @foreach ($financeiras as $fin)
                                            <option value="{{ $fin->id }}">{{ $fin->nome_financeira }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group flex flex-col">
                                    <label class="form-label text-xs">Correspondente</label>
                                    <select name="correspondente_id" id="correspondente_id" class="form-select rounded-lg border text-xs">
                                        <option value="0">Selecione a tabela</option>
                                        @foreach ($correspondentes as $corr)
                                            <option value="{{ $corr->id }}">{{ $corr->nome_correspondente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row flex flex-row text-xs">
                            <div class="col-4">
                                <div class="form-group flex flex-col">
                                    <label class="form-label text-xs">Produto</label>
                                    <select name="produto_id" id="produto_id" class="form-select rounded-lg border text-xs">
                                        <option value="0">Selecione a tabela</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ strtoupper($produto->descricao_produto) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="col flex flex-col">
                                    <label for="prazo_proposta" class="form-label">Prazo</label>
                                    <input type="number" name="prazo_proposta" id="prazo_proposta" min="0" max="999" step="1"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="col flex flex-col">
                                    <label for="total_proposta" class="form-label">Total</label>
                                    <input type="number" name="total_proposta" id="total_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="col flex flex-col">
                                    <label for="parcela_proposta" class="form-label">Parcela</label>
                                    <input type="number" name="parcela_proposta" id="parcela_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="col flex flex-col">
                                    <label for="liquido_proposta" class="form-label">Líquido</label>
                                    <input type="number" name="liquido_proposta" id="liquido_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs" onblur="calcularComissoes()">
                                </div>
                            </div>
                        </div>
                        <div class="row flex flex-row text-xs">
                            <div class="col-4 flex flex-row">
                                <div class="w-100 col-5 flex flex-col text-xs">
                                    <label class="form-label">% Loja</label>
                                    <input type="number" name="percentual_loja" id="perc_loja" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-7 flex flex-col text-xs">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_loja" id="val_loja" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-4 flex flex-row">
                                <div class="col-5 flex flex-col text-xs">
                                    <label class="form-label text-xs">% Agente</label>
                                    <input type="number" name="percentual_agente" id="perc_agente" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-7 flex flex-col text-xs">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_agente" id="val_agente" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-4 flex flex-row text-xs">
                                <div class="col-5 flex flex-col">
                                    <label class="form-label text-xs">% Corretor</label>
                                    <input type="number" name="percentual_corretor" id="perc_corretor" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-7 flex flex-col">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_corretor" id="val_corretor" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="cliente_id" value="{{ $cliente->id }}" id="cliente_id" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-midas-layout>
