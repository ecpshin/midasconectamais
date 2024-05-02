{{-- <x-midas-layout>
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
</x-midas-layout> --}}
<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <form action="{{ route('admin.propostas.store') }}" method="post">
                @csrf
                <div class="mb-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h4 class="rounded-lg bg-gradient-to-br from-slate-900 to-indigo-700 py-2 text-center text-slate-50">Cliente</h4>
                    <div class="space-between flex flex-col gap-3 bg-white px-3 py-4 text-indigo-700">
                        <div class="row space-between flex flex-row px-4 text-xs">
                            <div class="col-lg-8 mb-3 flex flex-col">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" value="{{ old('nome') }}" id="nome" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-2 mb-3 flex flex-col">
                                <label class="form-label">CPF</label>
                                <input type="text" name="cpf" value="{{ old('cpf') }}" id="cpf" class="cpf form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-2 mb-3 flex flex-col">
                                <label class="form-label">Data Nasc.</label>
                                <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}" id="data_nascimento"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                        <div class="row space-between flex flex-row px-4 text-xs">
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">RG</label>
                                <input type="text" name="rg" value="{{ old('rg') }}" id="rg" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Org. Exp.</label>
                                <input type="text" name="orgao_exp" value="{{ old('orgao_exp', 'SSP/RN') }}" id="orgao_exp"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Data Exp.</label>
                                <input type="date" name="data_exp" value="{{ old('data_exp') }}" id="data_exp" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Naturalidade</label>
                                <input type="text" name="naturalidade" value="{{ strtoupper($cliente->naturalidade) ?? 'Não informado' }}" id="naturalidade"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                        </div>
                        <div class="row space-between flex flex-row px-4 text-xs">
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Genitora</label>
                                <input type="text" name="genitora" value="{{ old('genitora', 'Não informado') }}" id="genitora"
                                    class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Genitor</label>
                                <input type="text" name="genitor" value="{{ old('genitor', 'Não informado') }}" id="genitor"
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
                        <div class="row space-between flex flex-row px-4 text-xs">
                            <div class="col-lg-3 mb-3 flex flex-col">
                                <label class="form-label">Tel. Principal</label>
                                <input type="text" name="phone1" value="{{ old('phone1', '(84)9 9999-9999') }}" id="phone1"
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
                    <h4 class="rounded-lg bg-gradient-to-br from-slate-900 to-indigo-700 py-2 text-center text-slate-50">Dados da Proposta</h4>
                    <div class="space-between flex flex-col gap-3 bg-white px-3 py-4 text-indigo-700">
                        <div class="row space-between flex flex-row px-4 text-xs">
                            <div class="col-lg-2 flex flex-col">
                                <label for="uuid" class="form-label">Controle</label>
                                <input type="text" name="uuid" id="uuid" value="{{ substr($uuid, 0, 18) }}" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3 flex flex-col">
                                <label for="numero_contrato" class="form-label">Nº Contrato</label>
                                <input type="text" name="numero_contrato" id="numero_contrato" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-2 flex flex-col">
                                <label for="data_digitacao" class="form-label">Digitado</label>
                                <input type="date" name="data_digitacao" id="data_digitacao" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-2 flex flex-col">
                                <label for="data_pagamento" class="form-label">Pago</label>
                                <input type="date" name="data_pagamento" id="data_pagamento" class="form-input rounded-lg border-gray-300 text-xs">
                            </div>
                            <div class="col-lg-3">
                                <div class="flex flex-col">
                                    <label class="form-label text-xs">Situação</label>
                                    <select name="situacao_id" id="situacao_id" class="form-select rounded-lg border text-xs">
                                        @foreach ($situacoes as $situacao)
                                            <option value="{{ $situacao->id }}">{{ $situacao->descricao_situacao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row space-between flex flex-row px-4 text-xs">
                            <div class="col-lg-3">
                                <div class="flex flex-col">
                                    <label class="form-label text-xs">Órgão</label>
                                    <select name="organizacao_id" id="organizacao_id" data-url="{{ route('api.tabelas', 0) }}" onchange="teste(this)"
                                        class="form-select rounded-lg border text-xs">
                                        <option value="">Selecione o órgão</option>
                                        @foreach ($orgaos as $orgao)
                                            <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="flex flex-col">
                                    <label class="form-label text-xs">Tabela</label>
                                    <select name="tabela_id" id="tabela_id" data-url="{{ route('api.tabela', 0) }}" class="form-select rounded-lg border text-xs">
                                        <option value="0">Selecione a tabela</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="flex flex-col">
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
                                <div class="flex flex-col">
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
                        <div class="row space-between flex flex-row px-4 text-xs">
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
                            <div class="col-lg-2 mb-3">
                                <div class="flex flex-col">
                                    <label for="prazo_proposta" class="form-label">Prazo</label>
                                    <input type="number" name="prazo_proposta" id="prazo_proposta" min="0" max="999" step="1"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="flex flex-col">
                                    <label for="total_proposta" class="form-label">Total</label>
                                    <input type="number" name="total_proposta" id="total_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="flex flex-col">
                                    <label for="parcela_proposta" class="form-label">Parcela</label>
                                    <input type="number" name="parcela_proposta" id="parcela_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="flex flex-col">
                                    <label for="liquido_proposta" class="form-label">Líquido</label>
                                    <input type="number" name="liquido_proposta" id="liquido_proposta" min="0.00" max="1000000.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs" onblur="calcularComissoes()">
                                </div>
                            </div>
                        </div>
                        <div class="row space-between flex flex-row px-4 text-xs">
                            <div class="col-lg-4 flex flex-row">
                                <div class="col-lg-5 flex flex-col text-xs">
                                    <label class="form-label">% Loja</label>
                                    <input type="number" name="percentual_loja" id="perc_loja" min="0.00" max="100.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col text-xs">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_loja" id="val_loja" min="0.00" step="0.01" max="1000000.00"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-4 flex flex-row">
                                <div class="col-lg-5 flex flex-col text-xs">
                                    <label class="form-label text-xs">% Agente</label>
                                    <input type="number" name="percentual_agente" id="perc_agente" min="0.00" max="100.00" step="0.01"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col text-xs">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_agente" id="val_agente" min="0.00" step="0.01" max="1000000.00"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
                            <div class="col-lg-4 flex flex-row text-xs">
                                <div class="col-lg-5 flex flex-col">
                                    <label class="form-label text-xs">% Corretor</label>
                                    <input type="number" name="percentual_corretor" id="perc_corretor" min="0.00" step="0.01" max="100.00"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                                <div class="col-lg-7 flex flex-col">
                                    <label class="form-label">R$</label>
                                    <input type="number" name="valor_corretor" id="val_corretor" min="0.00" step="0.01" max="1000000.00"
                                        class="form-input rounded-lg border-gray-300 text-right text-xs">
                                </div>
                            </div>
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
