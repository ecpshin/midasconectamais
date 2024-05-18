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
                                        <button type="button" data-toggle="modal" data-target="#modal-lg">ID</button>
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
                            <div class="row flex flex-row justify-between text-xs">
                                <div class="col-lg-4 mb-3 flex flex-row">
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
                                <div class="col-lg-4 mb-3 flex flex-row">
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
                                <div class="col-lg-4 mb-3 flex flex-row">
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
{{-- <x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="mx-auto w-full px-8 py-8">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.clientes.store') }}" method="post" class="flex flex-col px-3">@csrf
                <fieldset x-show="true" title="Dados pessoais" class="mb-3 flex flex-col gap-2 rounded-lg p-4 outline outline-1 outline-slate-700">
                    <h3 class="rounded bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Pessoais</h3>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-6 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="nome">Nome Completo</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome completo">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" maxlength="14" size="14" required value="{{ old('cpf') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="CPF">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="data_nascimento">Data Nasc.</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                title="Data de nascimento">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="rg">RG</label>
                            <input type="text" name="rg" id="rg" value="{{ old('rg') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="RG">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="orgao_exp">Órgão Exp</label>
                            <input type="text" name="orgao_exp" id="orgao_exp" value="{{ old('orgao_exp') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Órgão expedidor">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="data_exp">Data Exp.</label>
                            <input type="date" name="data_exp" id="data_exp" value="{{ old('data_exp') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                title="Data da expedição">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="naturalidade">Naturalidade</label>
                            <input type="text" name="naturalidade" id="naturalidade" value="{{ old('naturalidade') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Naturalidade">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="genitora">Nome da Mãe</label>
                            <input type="text" name="genitora" id="genitora" value="{{ old('genitora') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome da mãe">
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="genitor">Nome do Pai</label>
                            <input type="text" name="genitor" id="genitor" value="{{ old('genitor') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome do pai">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="sexo">Sexo</label>
                            <select name="sexo" id="sexo" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="Masculino">Selecione</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Não Binário (LGBTQI+)">Não Binário (LGBTQI+)</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="estado_civil">Estado Civil</label>
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
                            <label class="text-sm text-slate-500" for="phone1">Tel. Principal</label>
                            <input type="text" name="phone1" id="phone1" value="{{ old('phone1') }}"
                                class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="phone2">Tel. Família</label>
                            <input type="text" name="phone2" id="phone2" value="{{ old('phone2') }}"
                                class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="phone3">Tel. Recado 1</label>
                            <input type="text" name="phone3" id="phone3" value="{{ old('phone3') }}"
                                class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="phone">Tel. Recado 2</label>
                            <input type="text" name="phone4" id="phone4" value="{{ old('phone4') }}"
                                class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                    </div>
                </fieldset>
                InfoResidenciais
                <fieldset title="Informações Residenciais" class="mb-4 flex flex-col gap-2 rounded-lg p-4 outline outline-1 outline-slate-700">
                    <h3 class="rounded bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Residenciais</h3>
                    <div class="row mx-3 mt-2 justify-between">
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="buscaCep">CEP</label>
                            <input type="search" name="cep" id="buscaCep" value="{{ old('cep') }}" size="10" maxlength="8"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="59000000">
                        </div>
                        <div class="col-lg-6 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="logradouro">Endereço, nº</label>
                            <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Rua Tabajara, 10">
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="complemento">Complemento</label>
                            <input type="text" name="complemento" id="complemento" value="{{ old('complemento') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Ex.: Condomínio das Acácias Bloco 2 Apto. 503 5º Andar">
                        </div>
                    </div>
                    <div class="row mx-3 mt-2 justify-between">
                        <div class="col-lg-5 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="bairro">Bairro</label>
                            <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="Bairro">
                        </div>
                        <div class="col-lg-5 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="localidade">Cidade</label>
                            <input type="text" name="localidade" id="localidade" value="{{ old('localidade') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="Cidade">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="uf">UF</label>
                            <input type="text" name="uf" id="uf" value="{{ old('uf') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="RN">
                        </div>
                    </div>
                </fieldset>
                <!-- -->
                <fieldset title="Info Funcionais" class="mb-4 flex flex-col gap-2 rounded-lg p-4 outline outline-1 outline-slate-700">
                    <h3 class="rounded bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Funcionais</h3>
                    <div class="row mx-3 flex flex-row justify-between px-3 pb-3">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="organizacao_id">Órgão</label>
                            <select name="organizacao_id" id="organizacao_id" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($orgaos as $orgao)
                                    <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                @empty
                                    <option value="1">Não há órgãos cadastrados</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="nrbeneficio">Nº Benefício | Matrícula</label>
                            <input type="text" name="nrbeneficio" id="nrbeneficio" value="{{ old('nrbeneficio') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Número do benefício ou matrícula">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="Senha e e-mails">Emails</label>
                            <input id="email" name="email" type="email" value="{{ old('email', 'cliente@email.com') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="Email">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="Senha e e-mails">Senha</label>
                            <input type="text" id="senha" name="senha" value="{{ old('senha', '*********') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="Senhas">
                        </div>
                    </div>
                </fieldset>

                <fieldset title="infoBancárias" class="mb-4 flex flex-col gap-2 rounded-lg p-2 outline outline-1 outline-slate-700">
                    <h3 class="rounded bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Bancários</h3>
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="codigo">Código</label>
                            <input type="search" name="codigo" id="buscaBanco" value="{{ old('codigo') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="001">
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
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="0000-x">
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
                </fieldset>

                <div class="my-3 flex items-center justify-center gap-2">
                    <button type="submit"
                        class="rounded-lg bg-emerald-500 px-6 py-1.5 text-gray-100 transition duration-150 hover:bg-emerald-900 hover:text-slate-50 hover:shadow-xl">Salvar</button>
                    <button type="reset" class="rounded-lg bg-red-700 px-6 py-1.5 text-slate-100 transition duration-150 hover:bg-opacity-70 hover:shadow-xl">Limpar</button>
                </div>
            </form>
            </div>
        </div>
</x-midas-layout> --}}
