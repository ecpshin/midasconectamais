<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>
    <div class="w-full">
        <form action="{{ route('admin.propostas.special') }}" method="post">
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
                                    class="cep form-input rounded-lg border-gray-300 text-xs" placeholder="CEP" title="Somente números">
                            </div>
                            <div class="col-lg-6 form-group flex flex-col">
                                <label class="form-label">Endereço</label>
                                <input type="text" name="logradouro" value="{{ old('logradouro') }}" id="logradouro" class="form-input rounded-lg border-gray-300 text-xs"
                                    placeholder="Aguardando o CEP" title="Digite o cep para obter os dados">
                            </div>
                            <div class="col-lg-4 form-group flex flex-col">
                                <label class="form-label">Complemento</label>
                                <input type="text" name="complemento" value="{{ old('complemento', 'Complemento') }}" id="complemento"
                                    class="form-input rounded-lg border-gray-300 text-xs" placeholder="Complemento">
                            </div>
                        </div>
                        <div class="row flex flex-row justify-between text-xs">
                            <div class="col-lg-5 form-group flex flex-col">
                                <label class="form-label">Bairro</label>
                                <input type="text" name="bairro" maxlength="8" value="{{ old('bairro') }}" id="bairro"
                                    class="form-input rounded-lg border-gray-300 text-xs" placeholder="Aguardando o CEP" title="Digite o cep para obter os dados">
                            </div>
                            <div class="col-lg-5 form-group flex flex-col">
                                <label class="form-label">Localidade</label>
                                <input type="text" name="localidade" value="{{ old('localidade') }}" id="localidade" class="form-input rounded-lg border-gray-300 text-xs"
                                    placeholder="Aguardando o CEP" title="Digite o cep para obter os dados">
                            </div>
                            <div class="col-lg-2 form-group flex flex-col">
                                <label class="form-label">UF</label>
                                <input type="text" name="uf" value="{{ old('uf', 'RN') }}" id="uf" class="form-input rounded-lg border-gray-300 text-xs"
                                    placeholder="Endereço">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Dados Funcionais</h5>
                    <div class="flex flex-col gap-4 p-3 text-indigo-700">
                        <div class="row flex w-full flex-row justify-between text-xs">
                            <div class="col-lg-3 flex flex-col">
                                <label class="form-label">N° Matrícula | Benefício</label>
                                <input type="text" name="nrbeneficio" class="rounded-lg border-gray-300 text-xs" placeholder="Matrícula ou benefício do cliente">
                            </div>
                            <div class="col-lg-3 flex flex-col">
                                <label class="form-label text-xs">Órgão</label>
                                <select id="orgao" class="form-select rounded-lg border text-xs">
                                    <option value="0">Selecione o órgão</option>
                                    @forelse ($orgaos as $orgao)
                                        <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                    @empty
                                        Não há vínculos válidos
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-lg-3 flex flex-col">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', 'default@email.com') }}" class="rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 flex flex-col">
                                <label class="form-label">Senha</label>
                                <input type="text" name="senha" value="{{ old('senha', 'senha') }}" class="rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h5 class="w-100 rounded-lg bg-gradient-to-br from-slate-800 to-indigo-800 py-2 text-center text-slate-50">Informações Bancárias</h5>
                    <div title="Informações Bancárias" class="mb-4 flex flex-col gap-2 rounded-lg p-2 outline outline-1 outline-slate-700">
                        <div class="row mx-3 justify-between px-3 pb-3">
                            <div class="col-lg-2 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500" for="codigo">Código</label>
                                <input type="search" name="codigo" id="buscaBanco" value="{{ old('codigo') }}"
                                    class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                    placeholder="001">
                            </div>
                            <div class="col-lg-8 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500" for="banco">Nome Banco</label>
                                <input type="text" name="banco" id="banco" value="{{ old('banco') }}"
                                    class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                    placeholder="Banco da Caixola S.A.">
                            </div>
                            <div class="col-lg-2 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500" for="agencia">Agência</label>
                                <input type="text" name="agencia" id="agencia" value="{{ old('agencia') }}"
                                    class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                    placeholder="0000-x">
                            </div>
                        </div>
                        <div class="row mx-3 justify-between px-3 pb-3">
                            <div class="col-lg-4 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500" for="conta">Conta</label>
                                <input type="text" name="conta" id="conta" value="{{ old('conta') }}"
                                    class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                    placeholder="Ex.: 12313-5">
                            </div>
                            <div class="col-lg-4 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500" for="tipo_conta">Tipo Conta</label>
                                <select name="tipo_conta" id="tipo_conta" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                    <option value="Conta Corrente">Selecione</option>
                                    <option value="Conta Corrente">Conta Corrente</option>
                                    <option value="Conta Poupança">Conta Poupança</option>
                                    <option value="Conta Salário">Conta Salário</option>
                                    <option value="Conta Benefício">Conta Benefício</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500" for="operacao">Operação</label>
                                <input type="text" name="operacao" id="operacao" value="{{ old('operacao') }}"
                                    class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                    placeholder="Código ou nome da operação">
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
                                <input type="text" name="numero_contrato" id="numero_contrato" value="{{ old('numero_contrato', '00000000000') }}"
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
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label class="form-label text-xs">Produto</label>
                                    <select name="situacao_id" id="situacao_id" class="form-select rounded-lg border text-xs">
                                        <option value="5">Selecione a tabela</option>
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
                                        value="{{ old('prazo_proposta', '12') }}" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label for="total_proposta" class="form-label">Total</label>
                                    <input type="number" name="total_proposta" id="total_proposta" value="{{ old('total_proposta') }}" min="0.00" max="1000000.00"
                                        step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label for="parcela_proposta" class="form-label">Parcela</label>
                                    <input type="number" name="parcela_proposta" id="parcela_proposta" value="{{ old('parcela_proposta') }}" min="0.00" max="1000000.00"
                                        step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label for="liquido_proposta" class="form-label">Líquido</label>
                                    <input type="number" name="liquido_proposta" id="liquido_proposta" value="{{ old('liquido_proposta') }}" min="0.00" max="1000000.00"
                                        step="0.01" class="form-input rounded-lg border-gray-300 text-right text-xs" onblur="calcularComissoes()">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group flex flex-col">
                                    <label class="form-label text-xs">Situação</label>
                                    <select name="produto_id" id="produto_id" class="form-select rounded-lg border text-xs">
                                        <option value="0">Status da Proposta</option>
                                        @foreach ($situacoes as $situacao)
                                            <option value="{{ $situacao->id }}">{{ strtoupper($situacao->descricao_situacao) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                         
                        <div class="row flex flex-row justify-between text-xs @if (!Auth::user()->hasrole('super-admin')) d-none @endif">
                            <div class="col-lg-4 mb-3 flex flex-row">
                                <div class="col-lg-5 flex flex-col text-xs">
                                    <label class="form-label">% Loja</label>
                                    <input type="number" name="percentual_loja" id="perc_loja" value="{{ old('percentual_loja', '0.00') }}" step="0.01" min="0.00"
                                        max="100.00" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col text-xs">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_loja" id="val_loja" value="{{ old('valor_loja', '0.00') }}" step="0.01" min="0.00"
                                        max="1000000000.00" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3 flex flex-row">
                                <div class="col-lg-5 flex flex-col text-xs">
                                    <label class="form-label">% Agente</label>
                                    <input type="number" name="percentual_agente" id="perc_agente" value="{{ old('percentual_agente', '0.00') }}" step="0.01"
                                        min="0.00" max="100.00" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col text-xs">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_agente" id="val_agente" value="{{ old('valor_agente', '0.00') }}" step="0.01" min="0.00"
                                        max="1000000000.00" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3 flex flex-row">
                                <div class="col-lg-5 flex flex-col text-xs">
                                    <label class="form-label">% Corretor</label>
                                    <input type="number" name="percentual_corretor" id="perc_corretor" value="{{ old('percentual_corretor', '0.00') }}"step="0.01"
                                        min="0.00" max="100.00" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_corretor" id="val_corretor" value="{{ old('valor_corretor', '0.00') }}" step="0.01" min="0.00"
                                        max="1000000000.00" class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="mb-3 w-auto rounded-full bg-gradient-to-bl from-emerald-900 to-emerald-500 px-8 py-2 text-stone-100">Salvar
                        Dados</button>
                </div>
            </div>
        </form>
    </div>
</x-midas-layout>
