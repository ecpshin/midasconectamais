<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <form action="{{ route('admin.clientes.special') }}" method="post" enctype="multipart/form-data" id="proposta-cliente">
                @csrf
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados Pessoais</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <fieldset x-show="true" title="Dados pessoais" class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="row mx-3 justify-between px-3 py-2">
                                <div class="col-lg-6 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="nome">Nome Completo</label>
                                    <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Nome completo">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="cpf">CPF</label>
                                    <input type="text" name="cpf" id="cpf" maxlength="14" size="14" required value="{{ old('cpf') }}"
                                        class="cpf rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="CPF">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="data_nascimento">Data Nasc.</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento', '1970-01-01') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        title="Data de nascimento">
                                </div>
                            </div>
                            <div class="row mx-3 justify-between px-3 py-2">
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="rg">RG</label>
                                    <input type="text" name="rg" id="rg" value="{{ old('rg') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="RG">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="orgao_exp">Órgão Exp</label>
                                    <input type="text" name="orgao_exp" id="orgao_exp" value="{{ old('orgao_exp', 'SSP-RN') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Órgão expedidor">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="data_exp">Data Exp.</label>
                                    <input type="date" name="data_exp" id="data_exp" value="{{ old('data_exp', date('Y-m-d')) }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        title="Data da expedição">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="naturalidade">Naturalidade</label>
                                    <input type="text" name="naturalidade" id="naturalidade" value="{{ old('naturalidade', 'Naturalidade') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Naturalidade">
                                </div>
                            </div>
                            <div class="row mx-3 justify-between px-3 py-2">
                                <div class="col-lg-4 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="genitora">Nome da Mãe</label>
                                    <input type="text" name="genitora" id="genitora" value="{{ old('genitora', 'Mãe') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Nome da mãe">
                                </div>
                                <div class="col-lg-4 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="genitor">Nome do Pai</label>
                                    <input type="text" name="genitor" id="genitor" value="{{ old('genitor', 'Pai') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Nome do pai">
                                </div>
                                <div class="col-lg-2 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="sexo">Sexo</label>
                                    <select name="sexo" id="sexo" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        <option value="Não definido">Selecione</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                        <option value="Não Binário (LGBTQI+)">Não Binário (LGBTQI+)</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="estado_civil">Estado Civil</label>
                                    <select name="estado_civil" id="estado_civil" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        <option value="Não definido">Selecione</option>
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
                            <div class="row mx-3 justify-between px-3 pb-3">
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="phone1">Tel. Principal</label>
                                    <input type="text" name="phone1" id="phone1" value="{{ old('phone1', '84999999999') }}"
                                        class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="(84)9 9999-9999">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="phone2">Tel. Família</label>
                                    <input type="text" name="phone2" id="phone2" value="{{ old('phone2', '84999999999') }}"
                                        class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="(84)9 9999-9999">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="phone3">Tel. Recado 1</label>
                                    <input type="text" name="phone3" id="phone3" value="{{ old('phone3', '84999999999') }}"
                                        class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="(84)9 9999-9999">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="phone">Tel. Recado 2</label>
                                    <input type="text" name="phone4" id="phone4" value="{{ old('phone4', '84999999999') }}"
                                        class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="(84)9 9999-9999">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados Residenciais</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <fieldset title="Informações Residenciais" class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="row mx-3 mt-2 justify-between">
                                <div class="col-lg-2 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="buscaCep">CEP</label>
                                    <input type="search" name="cep" id="buscaCep" value="{{ old('cep') }}" size="10" maxlength="8"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="59000000">
                                </div>
                                <div class="col-lg-6 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="logradouro">Endereço, nº</label>
                                    <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Rua Tabajara, 10">
                                </div>
                                <div class="col-lg-4 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="complemento">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" value="{{ old('complemento') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Ex.: Condomínio das Acácias Bloco 2 Apto. 503 5º Andar">
                                </div>
                            </div>
                            <div class="row mx-3 mt-2 justify-between">
                                <div class="col-lg-5 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="bairro">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Bairro">
                                </div>
                                <div class="col-lg-5 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="localidade">Cidade</label>
                                    <input type="text" name="localidade" id="localidade" value="{{ old('localidade') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Cidade">
                                </div>
                                <div class="col-lg-2 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="uf">UF</label>
                                    <input type="text" name="uf" id="uf" value="{{ old('uf') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="RN">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados Funcionais</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <fieldset title="Info Funcionais" class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="row mx-3 flex flex-row justify-between px-3 pb-3">
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500">Órgão</label>
                                    <select name="orgao_id" id="orgao_id" class="form-select rounded-lg border text-xs">
                                        @foreach ($orgaos as $orgao)
                                            <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="nrbeneficio">Nº Benefício | Matrícula</label>
                                    <input type="text" name="nrbeneficio" id="nrbeneficio" value="{{ old('nrbeneficio') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Número do benefício ou matrícula">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="Senha e e-mails">Emails</label>
                                    <input id="email" name="email" type="email" value="{{ old('email', 'cliente@email.com') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Email">
                                </div>
                                <div class="col-lg-3 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="Senha e e-mails">Senha</label>
                                    <input type="text" id="senha" name="senha" value="{{ old('senha', '*********') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Senhas">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados Bancários</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <fieldset title="infoBancárias" class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="row mx-3 justify-between px-3 pb-3">
                                <div class="col-lg-2 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="codigo">Código</label>
                                    <input type="search" name="codigo" id="buscaBanco" value="{{ old('codigo') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="001">
                                </div>
                                <div class="col-lg-8 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="banco">Nome Banco</label>
                                    <input type="text" name="banco" id="banco" value="{{ old('banco') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Banco da Caixola S.A.">
                                </div>
                                <div class="col-lg-2 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="agencia">Agência</label>
                                    <input type="text" name="agencia" id="agencia" value="{{ old('agencia') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="0000-x">
                                </div>
                            </div>
                            <div class="row mx-3 justify-between px-3 pb-3">
                                <div class="col-lg-4 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="conta">Conta</label>
                                    <input type="text" name="conta" id="conta" value="{{ old('conta') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Ex.: 12313-5">
                                </div>
                                <div class="col-lg-4 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="tipo_conta">Tipo Conta</label>
                                    <select name="tipo_conta" id="tipo_conta" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        <option value="Conta Corrente">Selecione</option>
                                        <option value="Conta Corrente">Conta Corrente</option>
                                        <option value="Conta Poupança">Conta Poupança</option>
                                        <option value="Conta Salário">Conta Salário</option>
                                        <option value="Conta Benefício">Conta Benefício</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-2 flex flex-col">
                                    <label class="text-xs text-slate-500" for="operacao">Operação</label>
                                    <input type="text" name="operacao" id="operacao" value="{{ old('operacao') }}"
                                        class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                        placeholder="Código ou nome da operação">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados da Proposta</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <fieldset class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="flex flex-col gap-4 p-3 text-indigo-700">
                                <div class="row flex flex-row justify-between text-xs">
                                    <div class="col-lg-2 form-group flex flex-col">
                                        <label for="uuid" class="form-label">Controle</label>
                                        <input type="text" name="uuid" id="uuid" value="{{ old('uuid', $uuid) }}"
                                            class="form-input rounded-lg border-gray-300 text-right text-xs" readonly="true">
                                    </div>
                                    <div class="col-lg-2 form-group flex flex-col">
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
                                    <div class="col-lg-3 flex flex-col">
                                        <label class="form-label text-xs">Agente|Corretor</label>
                                        <select name="user_id" id="user_id" class="form-select rounded-lg border text-xs">
                                            <option value="">Selecione...</option>
                                            <optgroup label="Agentes">
                                                @forelse ($agentes as $agente)
                                                    <option value="{{ $agente->id }}" @if ($agente->id == Auth::user()->id) selected @endif>{{ $agente->name }}</option>
                                                @empty
                                                    <option value="">Não há agentes</option>
                                                @endforelse
                                            </optgroup>
                                            <optgroup label="Corretores">
                                                @forelse ($corretores as $corretor)
                                                    <option value="{{ $corretor->id }}">{{ $corretor->name }}</option>
                                                @empty
                                                    <option value="">Não há Corretores</option>
                                                @endforelse
                                            </optgroup>

                                        </select>
                                    </div>
                                </div>
                                <div class="row flex flex-row justify-between text-xs">
                                    <div class="col-lg-3">
                                        <div class="form-group flex flex-col">
                                            <label class="form-label text-xs">Órgão</label>
                                            <select name="organizacao_id" id="organizacao_id" data-url="{{ route('api.tabelas', 0) }}"
                                                class="form-select rounded-lg border text-xs">
                                                <option value="0">Selecione o órgão</option>
                                                @forelse ($orgaos as $orgao)
                                                    <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
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
                                    <div class="col-lg-2">
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
                                    <div class="col-lg-2">
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
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Carregar Arquivos</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <fieldset
                            class="mb-3 overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50 shadow-sm hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600 sm:rounded-lg">
                            <div class="flex w-full items-center justify-center">
                                <label class="dark:hover:bg-bray-800 flex h-32 w-full cursor-pointer flex-col items-center justify-center rounded-lg">
                                    <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                        <svg class="mb-4 h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-xs text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique para carregar</span></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">JPG, JPEG,PNG or PDF (MAX. 10MB)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" name="files[]" class="hidden" multiple>
                                </label>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="mt-3 bg-none px-10 pb-3">
                    <button type="submit" class="text-md rounded-full bg-gradient-to-b from-green-900 to-emerald-800 px-10 py-2 font-bold text-slate-50">Salvar
                        Dados</button>
                </div>
        </div>
        </form>
    </div>
    </div>
</x-midas-layout>
