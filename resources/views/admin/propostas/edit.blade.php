<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="mx-auto w-full sm:px-4 lg:px-6">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.propostas.update', $proposta) }}" method="post" id="post_update">
                @csrf @method('PATCH')
                <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados da Proposta</h5>
                <div class="flex flex-col gap-4 p-3 text-indigo-700">
                    <fieldset class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="flex flex-col gap-4 p-3 text-indigo-700">
                            <div class="row flex flex-row text-xs">
                                <div class="col-lg-2 mb-3 flex flex-col">
                                    <label class="form-label">ID</label>
                                    <input type="text" name="cliente_id" id="cliente_id"
                                        value="{{ $proposta->cliente->id }}"class="form-input rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="col-lg-8 mb-3 flex flex-col">
                                    <label class="form-label">Nome</label>
                                    <input type="text" id="nome_cliente" value="{{ $proposta->cliente->nome }}" class="form-input rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="col-lg-2 mb-3 flex flex-col">
                                    <label class="form-label">CPF</label>
                                    <input type="text" id="cpf_cliente" value="{{ substr($proposta->cliente->cpf, 0, 4) . '***.***-**' }}"
                                        class="form-input rounded-lg border-gray-300 text-xs">
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 p-3 text-indigo-700">
                            <div class="row flex flex-row justify-between text-xs">
                                <div class="col-lg-3 form-group flex flex-col">
                                    <label for="uuid" class="form-label">Controle</label>
                                    <input type="text" name="uuid" id="uuid" value="{{ $proposta->uuid }}"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs" readonly="true">
                                </div>
                                <div class="col-lg-5 form-group flex flex-col">
                                    <label for="numero_contrato" class="form-label">Nº Contrato</label>
                                    <input type="text" name="numero_contrato" id="numero_contrato" value="{{ old('numero_contrato', $proposta->numero_contrato) }}"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs" placeholder="Não informado">
                                </div>
                                <div class="col-lg-2 form-group flex flex-col">
                                    <label for="data_digitacao" class="form-label">Digitado</label>
                                    <input type="date" name="data_digitacao" id="data_digitacao"
                                        value="{{ old('data_digitacao', date('Y-m-d', strtotime($proposta->data_digitacao))) }}"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-2 form-group flex flex-col">
                                    <label for="data_pagamento" class="form-label">Pago</label>
                                    <input type="date" name="data_pagamento" id="data_pagamento"
                                        value="{{ old('data_pagamento', date('Y-m-d', strtotime($proposta->data_pagamento))) }}"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="row flex flex-row justify-between text-xs">
                                <div class="col-lg-3">
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Órgão</label>
                                        <select name="organizacao_id" id="organizacao_id" data-url="{{ route('api.tabelas', 0) }}" class="form-select rounded-lg border text-xs">
                                            <option value="0">Selecione o órgão</option>
                                            @forelse ($orgaos as $orgao)
                                                <option value="{{ $orgao->id }}" @if ($orgao->id == $proposta->comissao->tabela->organizacao_id) selected @endif>{{ $orgao->nome_organizacao }}</option>
                                            @empty
                                                Não há vínculos válidos
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Tabela</label>
                                        <select name="tabela_id" id="tabela_id" data-url="{{ route('api.tabela', 0) }}" class="form-select rounded-lg border text-xs">
                                            <option value="{{ $proposta->comissao->tabela_id }}">
                                                {{ $proposta->comissao->tabela->produto->descricao_produto . ' | ' . $proposta->comissao->tabela->descricao . ' | ' . $proposta->comissao->tabela->financeira->nome_financeira . ' | ' . $proposta->comissao->tabela->correspondente->nome_correspondente }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Financeira</label>
                                        <select name="financeira_id" id="financeira_id" class="form-select rounded-lg border text-xs">
                                            <option value="0">Selecione a tabela</option>
                                            @forelse ($financeiras as $fin)
                                                <option value="{{ $fin->id }}" @if ($fin->id == $proposta->financeira_id) selected @endif>{{ $fin->nome_financeira }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Correspondente</label>
                                        <select name="correspondente_id" id="correspondente_id" class="form-select rounded-lg border text-xs">
                                            <option value="0">Selecione a tabela</option>
                                            @forelse ($correspondentes as $corr)
                                                <option value="{{ $corr->id }}" @if ($corr->id == $proposta->correspondente_id) selected @endif>{{ $corr->nome_correspondente }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex flex-row justify-between text-xs">
                                <div class="col-lg-2">
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Produto</label>
                                        <select name="produto_id" id="produto_id" class="form-select rounded-lg border text-xs">
                                            <option value="0">Selecione a tabela</option>
                                            @forelse ($produtos as $produto)
                                                <option value="{{ $produto->id }}" @if ($produto->id == $proposta->produto_id) selected @endif>
                                                    {{ strtoupper($produto->descricao_produto) }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group flex flex-col">
                                        <label for="prazo_proposta" class="form-label">Prazo</label>
                                        <input type="number" name="prazo_proposta" id="prazo_proposta" value="{{ $proposta->prazo_proposta }}" min="0" max="999"
                                            step="1" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group flex flex-col">
                                        <label for="total_proposta" class="form-label">Total</label>
                                        <input type="number" name="total_proposta" id="total_proposta" value="{{ $proposta->total_proposta }}" min="0.00"
                                            max="1000000.00" step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group flex flex-col">
                                        <label for="parcela_proposta" class="form-label">Parcela</label>
                                        <input type="number" name="parcela_proposta" id="parcela_proposta" value="{{ $proposta->parcela_proposta }}" min="0.00"
                                            max="1000000.00" step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group flex flex-col">
                                        <label for="liquido_proposta" class="form-label">Líquido</label>
                                        <input type="number" name="liquido_proposta" id="liquido_proposta" value="{{ $proposta->liquido_proposta }}" min="0.00"
                                            max="1000000.00" step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs" onblur="atualizarComissoes()">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group flex flex-col">
                                        <label class="form-label text-xs">Situação</label>
                                        <select name="situacao_id" id="situacao_id" class="form-select rounded-lg border text-xs">
                                            @foreach ($situacoes as $situacao)
                                                <option value="{{ $situacao->id }}" @if ($situacao->id == $proposta->situacao_id) selected @endif>
                                                    {{ is_null($situacao->motivo_situacao) ? $situacao->descricao_situacao : $situacao->descricao_situacao . ' > ' . $situacao->motivo_situacao }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex flex-row justify-start text-xs">
                                <div class="{{ Auth::user()->hasRole('super-admin') ? 'col-lg-4 mb-3 flex flex-row' : 'hidden' }}">
                                    <div class="col-lg-5 flex flex-col text-xs">
                                        <label class="form-label">% Loja</label>
                                        <input type="number" name="percentual_loja" id="perc_loja" value="{{ $proposta->comissao->percentual_loja }}" min="0.00"
                                            max="100.00" step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                    <div class="col-lg-7 flex flex-col text-xs">
                                        <label class="form-label">R$</label>
                                        <input type="number" name="valor_loja" id="val_loja" value="{{ $proposta->comissao->valor_loja }}" min="0.00" max="1000000.00"
                                            step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="{{ Auth::user()->hasRole('super-admin') || Auth::user()->tipo != 'corretor' ? 'col-lg-4 mb-3 flex flex-row' : 'hidden' }}">
                                    <div class="col-lg-5 flex flex-col text-xs">
                                        <label class="form-label">% Agente</label>
                                        <input type="number" name="percentual_agente" id="perc_agente" value="{{ $proposta->comissao->percentual_agente }}" min="0.00"
                                            max="100.00" step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                    <div class="col-lg-7 flex flex-col text-xs">
                                        <label class="form-label">R$</label>
                                        <input type="number" name="valor_agente" id="val_agente" value="{{ $proposta->comissao->valor_agente }}" min="0.00"
                                            max="1000000.00" step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                                <div class="{{ Auth::user()->hasRole('super-admin') || Auth::user()->tipo != 'agente' ? 'col-lg-4 mb-3 flex flex-row' : 'hidden' }}">
                                    <div class="col-lg-5 flex flex-col text-xs">
                                        <label class="form-label">% Corretor</label>
                                        <input type="number" name="percentual_corretor" id="perc_corretor" value="{{ $proposta->comissao->percentual_corretor }}"
                                            min="0.00" max="100.00" step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                    <div class="col-lg-7 flex flex-col">
                                        <label class="form-label">R$</label>
                                        <input type="number" name="valor_corretor" id="val_corretor" value="{{ $proposta->comissao->valor_corretor }}" min="0.00"
                                            max="1000000.00" step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div>
                        <button type="submit" class="rounded-lg bg-green-700 px-10 py-2 text-stone-50">Atualizar</button>
                        <a href="{{ route('admin.propostas.index') }}" role="button" class="rounded-lg bg-slate-700 px-10 py-2 text-stone-50">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-midas-layout>
