<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>
    <div class="w-full">
        <form action="{{ route('admin.propostas.store') }}" method="post">
            @csrf
            <div class="mx-auto w-full sm:px-4 lg:px-6">
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h4 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados Pessoais - Cliente</h4>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        @csrf
                        <div class="row flex flex-row text-xs">
                            <div class="col-lg-8 mb-3 flex flex-col">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" value="{{ strtoupper($cliente->nome) }}" id="nome" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-2 mb-3 flex flex-col">
                                <label class="form-label">CPF</label>
                                <input type="text" name="cpf" value="{{ $cliente->cpf }}" id="cpf" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-2 mb-3 flex flex-col">
                                <label class="form-label">Data Nasc.</label>
                                <input type="date" name="data_nascimento" value="{{ !is_null($cliente->data_nascimento) ? $cliente->data_nascimento->format('Y-m-d') : null }}"
                                    id="data_nascimento" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                        <div class="row flex flex-row text-xs">
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">RG</label>
                                <input type="text" name="rg" value="{{ strtolower($cliente->rg) }}" id="rg" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Org. Exp.</label>
                                <input type="text" name="orgao_exp" value="{{ strtoupper($cliente->orgao_exp) ?? 'SSP/RN' }}" id="orgao_exp"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Data Exp.</label>
                                <input type="date" name="data_exp" value="{{ !is_null($cliente->data_exp) ? $cliente->data_exp->format('Y-m-d') : null }} " id="data_exp"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Naturalidade</label>
                                <input type="text" name="naturalidade" value="{{ strtoupper($cliente->naturalidade) ?? 'Não informado' }}" id="naturalidade"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                        <div class="row flex flex-row text-xs">
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Genitora</label>
                                <input type="text" name="genitora" value="{{ strtoupper($cliente->genitora) ?? 'Não informado' }}" id="genitora"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Genitor</label>
                                <input type="text" name="genitor" value="{{ strtoupper($cliente->genitor) ?? 'Não informado' }}" id="genitor"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Sexo</label>
                                <select name="sexo" id="sexo" class="form-select rounded-lg border text-xs">
                                    <option value="Masculino">Selecione</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Não Binário (LGBTQI+)">Não Binário (LGBTQI+)</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label" for="estado_civil">Estado Civil</label>
                                <select name="estado_civil" id="estado_civil" class="form-select rounded-lg border text-xs">
                                    <option value="Não informado">Selecione</option>
                                    <option value="Casado(a)">Casado(a)</option>
                                    <option value="Desquitado(a)">Desquitado(a)</option>
                                    <option value="Divorciado(a)">Divorciado(a)</option>
                                    <option value="Separado(a)">Separado(a)</option>
                                    <option value="Solteiro(a)">Solteiro(a)</option>
                                    <option value="União Estável">União Estável</option>
                                    <option value="União Estável Homoafetiva">União Estável Homoafetiva</option>
                                    <option value="Não informado">Não informado</option>
                                </select>
                            </div>
                        </div>
                        <div class="row flex flex-row text-xs">
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Tel. Principal</label>
                                <input type="text" name="phone1" value="{{ old('phone1', $cliente->telefone) }}" id="phone1"
                                    class="phone form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Familiar</label>
                                <input type="text" name="phone2" value="{{ old('phone2', '(84)9 9999-9999') }}" id="phone2"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Recado 1</label>
                                <input type="text" name="phone3" value="{{ old('phone3', '(84)9 9999-9999') }}" id="phone3"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Recado 2</label>
                                <input type="text" name="phone4" value="{{ old('phone4', '(84)9 9999-9999') }}" id="phone4"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados da Residenciais</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <div class="row flex flex-row justify-between text-xs">
                            <div class="col-lg-2 form-group flex flex-col">
                                <label class="form-label">CEP</label>
                                <input type="text" name="cep" maxlength="8" value="{{ old('cep') }}" id="buscaCep"
                                    class="cep form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-6 form-group flex flex-col">
                                <label class="form-label">Endereço</label>
                                <input type="text" name="logradouro" value="{{ old('logradouro') }}" id="logradouro" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-4 form-group flex flex-col">
                                <label class="form-label">Complemento</label>
                                <input type="text" name="complemento" value="{{ old('complemento', 'Complemento') }}" id="complemento"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                        <div class="row flex flex-row justify-between text-xs">
                            <div class="col-lg-5 form-group flex flex-col">
                                <label class="form-label">Bairro</label>
                                <input type="text" name="bairro" maxlength="8" value="{{ old('bairro') }}" id="bairro"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-5 form-group flex flex-col">
                                <label class="form-label">Localidade</label>
                                <input type="text" name="localidade" value="{{ old('localidade') }}" id="localidade" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-2 form-group flex flex-col">
                                <label class="form-label">UF</label>
                                <input type="text" name="uf" value="{{ old('uf', 'RN') }}" id="uf" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados Funcionais</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <div class="row flex w-full flex-row justify-between text-xs">
                            <div class="col-lg-4 flex flex-col justify-between gap-3">
                                <div class="flex flex-col">
                                    <label class="form-label">N° Matrícula | Benefício</label>
                                    <input type="text" name="nrbeneficio[]" class="rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label text-xs">Órgão</label>
                                    <select name="organizacao[]" id="orgao_1" class="form-select rounded-lg border text-xs">
                                        <option value="0">Selecione o órgão</option>
                                        @forelse ($orgaos as $orgao)
                                            <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                        @empty
                                            Não há vínculos válidos
                                        @endforelse
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email[]" class="rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label">Senha</label>
                                    <input type="text" name="senha[]" class="rounded-lg border-gray-300 text-xs">
                                </div>
                            </div>
                            <div class="col-lg-4 flex flex-col justify-between gap-3">
                                <div class="flex flex-col">
                                    <label class="form-label">N° Matrícula | Benefício</label>
                                    <input type="text" name="nrbeneficio[]" class="rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label text-xs">Órgão</label>
                                    <select name="organizacao[]" id="orgao_2" class="form-select rounded-lg border text-xs">
                                        <option value="0">Selecione o órgão</option>
                                        @forelse ($orgaos as $orgao)
                                            <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                        @empty
                                            Não há vínculos válidos
                                        @endforelse
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email[]" class="rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label">Senha</label>
                                    <input type="text" name="senha[]" class="rounded-lg border-gray-300 text-xs">
                                </div>
                            </div>
                            <div class="col-lg-4 flex flex-col justify-between gap-3">
                                <div class="flex flex-col">
                                    <label class="form-label">N° Matrícula | Benefício</label>
                                    <input type="text" name="nrbeneficio[]" class="rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label text-xs">Órgão</label>
                                    <select name="organizacao_id" id="orgao_3"class="form-select rounded-lg border text-xs">
                                        <option value="0">Selecione o órgão</option>
                                        @forelse ($orgaos as $orgao)
                                            <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                        @empty
                                            Não há vínculos válidos
                                        @endforelse
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email[]" id="email_3" class="rounded-lg border-gray-300 text-xs">
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label">Senha</label>
                                    <input type="text" name="senha[]" class="rounded-lg border-gray-300 text-xs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados da Proposta</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <div class="row flex flex-row justify-between text-xs">
                            <div class="col-lg-3 form-group flex flex-col">
                                <label for="uuid" class="form-label">Controle</label>
                                <input type="text" name="uuid" id="uuid" value="{{ old('uuid', $uuid) }}"
                                    class="form-input rounded-lg border-gray-300 text-right text-xs" readonly="true">
                            </div>
                            <div class="col-lg-5 form-group flex flex-col">
                                <label for="numero_contrato" class="form-label">Nº Contrato</label>
                                <input type="text" name="numero_contrato" id="numero_contrato" value="{{ old('numero_contrato') }}"
                                    class="form-input rounded-lg border-gray-300 text-right text-xs" placeholder="Não informado">
                            </div>
                            <div class="col-lg-2 form-group flex flex-col">
                                <label for="data_digitacao" class="form-label">Digitado</label>
                                <input type="date" name="data_digitacao" id="data_digitacao" value="{{ old('data_digitacao', date('Y-m-d')) }}"
                                    class="form-input rounded-lg border-gray-300 text-right text-xs">
                            </div>
                            <div class="col-lg-2 form-group flex flex-col">
                                <label for="data_pagamento" class="form-label">Pago</label>
                                <input type="date" name="data_pagamento" id="data_pagamento" value="{{ old('data_pagamento', null) }}"
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
                                            <option value="{{ $orgao->id }}" @if ($orgao->id == $cliente->organizacao->organizacao_id) selected @endif>{{ $orgao->nome_organizacao }}</option>
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
                                        <option value="0">Selecione a tabela</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
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
                            <div class="col-lg-3">
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
                        <div class="row flex flex-row justify-between text-xs">
                            <div class="col-lg-4">
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
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label for="prazo_proposta" class="form-label">Prazo</label>
                                    <input type="number" name="prazo_proposta" id="prazo_proposta" min="0" max="999" step="1"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label for="total_proposta" class="form-label">Total</label>
                                    <input type="number" name="total_proposta" id="total_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label for="parcela_proposta" class="form-label">Parcela</label>
                                    <input type="number" name="parcela_proposta" id="parcela_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label for="liquido_proposta" class="form-label">Líquido</label>
                                    <input type="number" name="liquido_proposta" id="liquido_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs" onblur="calcularComissoes()">
                                </div>
                            </div>
                        </div>
                        <div class="row flex flex-row justify-between text-xs">
                            <div class="col-lg-4 mb-3 flex flex-row">
                                <div class="col-lg-5 flex flex-col text-xs">
                                    <label class="form-label">% Loja</label>
                                    <input type="number" name="percentual_loja" id="perc_loja" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col text-xs">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_loja" id="val_loja" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3 flex flex-row">
                                <div class="col-lg-5 flex flex-col text-xs">
                                    <label class="form-label">% Agente</label>
                                    <input type="number" name="percentual_agente" id="perc_agente" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col text-xs">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_agente" id="val_agente" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3 flex flex-row">
                                <div class="col-lg-5 flex flex-col text-xs">
                                    <label class="form-label">% Corretor</label>
                                    <input type="number" name="percentual_corretor" id="perc_corretor" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col">
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
