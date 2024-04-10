<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.propostas.store') }}" method="post">
                @csrf
                <fieldset x-show="true" title="Dados pessoais" class="mb-3 flex flex-col gap-2 rounded-lg p-4 outline outline-1 outline-slate-500">
                    <h3 class="rounded bg-slate-900 py-2 text-center text-lg text-slate-50">Dados Pessoais</h3>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-6 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="nome">Nome Completo</label>
                            <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome completo">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" maxlength="14" size="14" required value="{{ $cliente->cpf }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="CPF">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="data_nascimento">Data Nasc.</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                title="Data de nascimento">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="rg">RG</label>
                            <input type="text" name="rg" id="rg" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="RG">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="orgao_exp">Órgão Exp</label>
                            <input type="text" name="orgao_exp" id="orgao_exp" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Órgão expedidor">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="data_exp">Data Exp.</label>
                            <input type="date" name="data_exp" id="data_exp" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                title="Data da expedição">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="naturalidade">Naturalidade</label>
                            <input type="text" name="naturalidade" id="naturalidade" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Naturalidade">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="genitora">Nome da Mãe</label>
                            <input type="text" name="genitora" id="genitora" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome da mãe">
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="genitor">Nome do Pai</label>
                            <input type="text" name="genitor" id="genitor" value=""
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
                </fieldset>
                <fieldset title="Info Funcionais" class="mb-4 flex flex-col gap-0 rounded-lg p-4 outline outline-1 outline-slate-500">
                    <h3 class="rounded-lg bg-slate-900 py-2 text-center text-lg text-slate-50">Dados Funcionais</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="my-3 flex flex-col">
                            <label for="organizacao_id">Órgão</label>
                            <select name="organizacao_id" id="organizacao_id" required
                                class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($orgaos as $orgao)
                                    <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                @empty
                                    <option value="1">Não há órgãos cadastrados</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="nrbeneficio">Nº Benefício | Matrícula</label>
                            <input type="text" name="nrbeneficio" id="nrbeneficio" value="{{ $cliente->matricual ?? 'Não informado' }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Número do benefício ou matrícula">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4">
                        <div class="my-3 flex flex-col">
                            <label for="phone1">Tel. Principal</label>
                            <input type="text" name="phone1" id="phone1" value="{{ $cliente->telefone }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="phone2">Tel. Família</label>
                            <input type="text" name="phone2" id="phone2" value="(84)9 0000-0000"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="phone3">Tel. Recado 1</label>
                            <input type="text" name="phone3" id="phone3" value="(84)9 0000-0000"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="phone">Tel. Recado 2</label>
                            <input type="text" name="phone4" id="phone4" value="(84)9 0000-0000"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="flex flex-col">
                            <label for="Senha e e-mails">Senha e emails</label>
                            <textarea id="emails_senhas" name="emails_senhas" class="mt-2 rounded-lg border-gray-400 placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-0"
                                placeholder="Espaço reservado para Senhas e Emails">Margem: {{ $cliente->margem }}, Orgão: {{ $cliente->orgao }}, Prodtuto oferecido: {{ $cliente->produto }}, {{ $cliente->observacoes }}</textarea>
                        </div>
                    </div>
                </fieldset>
                <fieldset title="infoBancárias" class="mb-4 flex flex-col gap-2 rounded-lg p-2 outline outline-1 outline-red-500">
                    <h3 class="rounded-lg bg-rose-900 py-2 text-center text-lg text-slate-50">Dados Bancários</h3>
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="codigo">Código</label>
                            <input type="search" name="codigo" id="buscaBanco" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="001">
                        </div>
                        <div class="col-lg-8 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="banco">Nome Banco</label>
                            <input type="text" name="banco" id="banco" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Banco da Caixola S.A.">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="agencia">Agência</label>
                            <input type="text" name="agencia" id="agencia" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="0000-x">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="conta">Conta</label>
                            <input type="text" name="conta" id="conta" value=""
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
                            <input type="text" name="operacao" id="operacao" value=""
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Código ou nome da operação">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="mb-3 flex flex-col gap-2 rounded-lg p-4 outline outline-1 outline-slate-500">
                    <h3 class="rounded-lg bg-slate-900 py-2 text-center text-lg text-slate-50">Dados da Proposta</h3>
                    <div class="row mx-3 flex justify-between px-3 pb-3">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500">Controle</label>
                            <input type="text" name="uuid" value="{{ \Ramsey\Uuid\Uuid::uuid4() }}" readonly
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
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="operacao_id">Operação</label>
                            <select name="operacao_id" id="operacao_id" class="rounded border-gray-300 py-1 text-sm focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($operacoes as $op)
                                    <option value="{{ $op->id }}">{{ $op->descricao_operacao }}</option>
                                @empty
                                    Não há Operações
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-1 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="prazo">Prazo</label>
                            <input type="number" name="prazo_proposta"
                                class="rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="prazo">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="total_proposta">Total</label>
                            <input type="number" name="total_proposta"
                                class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="total_proposta">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="parcela_proposta">Parcela</label>
                            <input type="number" name="parcela_proposta"
                                class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="parcela_proposta">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="liquido_proposta">Líquido</label>
                            <input type="number" name="liquido_proposta"
                                class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="liquido_proposta">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="situacao_id">Situação</label>
                            <select name="situacao_id" id="situacao_id" class="border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($situacoes as $situacao)
                                    <option value="{{ $situacao->id }}">{{ $situacao->descricao_situacao . ' > ' . $situacao->motivo_situacao }}</option>
                                @empty
                                    <option>Não há situações/option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="financeira_id">Financeiras</label>
                            <select name="financeira_id" id="financeira_id" class="border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($financeiras as $fin)
                                    <option value="{{ $fin->id }}">{{ $fin->nome_financeira }}</option>
                                @empty
                                    <option>Não ha financeiras</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="correspondente_id">Correspondente</label>
                            <select name="correspondente_id" id="correspondente_id" onchange="carrega(this)"
                                class="border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($correspondentes as $corr)
                                    <option value="{{ $corr->id }}" class="{{ $corr->percentual_comissao }}">
                                        {{ $corr->nome_correspondente }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500">Tabela</label>
                            <input type="text" name="tabela_comissao" value=""
                                class="rounded-lg border-gray-300 bg-white py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="tabela_comissao">
                        </div>
                        @can('create comissao')
                            <div class="col-lg-2 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500" for="percentual_loja">%Lj</label>
                                <input type="number" name="percentual_loja" value=""
                                    class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="percentual_loja">
                            </div>
                            <div class="col-lg-2 mb-2 flex flex-col">
                                <label class="text-sm text-slate-500">R$ Loja</label>
                                <input type="number" name="valor_loja" value=""
                                    class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="valor_loja">
                            </div>
                            <div class="col-lg-2 mb-2 flex w-full flex-col">
                                <label class="text-sm text-slate-500">%Ag</label>
                                <input type="number" name="percentual_operador" value=""
                                    class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="percentual_operador">
                            </div>
                            <div class="col-lg-2 mb-2 flex w-full flex-col">
                                <label class="text-sm text-slate-500">R$ Operador</label>
                                <input type="number" name="valor_operador" value=""
                                    class="valor rounded border-gray-300 bg-white py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="valor_operador">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
{{-- <div class="modal fade text-stone-700" id="modalLigacao" tabindex="-1" aria-labelledby="modaLigacaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5 text-slate-700" aria-label="modalLigacaoLabel">Call Center</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.calls.store') }}" class="mt-3" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 form-group mb-3">
                            <label class="text-xs font-semibold" for="data_ligacao">Ligação</label>
                            <input type="date" name="data_ligacao" id="data_ligacao"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                        <div class="col-lg-3 form-group mb-3">
                            <label class="text-xs font-semibold" for="agendado">Agendamento</label>
                            <input type="date" name="agendado" id="data_agendado"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                        <div class="col-lg-3 form-group mb-3">
                            <label class="text-xs font-semibold" for="status_id">Status</label>
                            <select name="status_id" id="status_id" class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                <option value="">Selecione</option>
                                @foreach ($statuses as $status)
                                <option value="{{$status->id}}">{{$status->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 form-group mb-3">
                            <label class="text-xs font-semibold" for="nome">Nome</label>
                            <input type="text" name="nome" id="nome"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                        <div class="col-lg-4 form-group mb-3">
                            <label class="text-xs font-semibold" for="cpf">CPF</label>
                            <input type="text" name="cpf" id="modal-cpf"
                                class="cpf w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 form-group mb-3">
                            <label class="text-xs font-semibold" for="matricula">Matrícula</label>
                            <input type="text" name="matricula" id="matricula"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            <label class="text-xs font-semibold" for="orgao">Órgão</label>
                            <input type="text" name="orgao" id="orgao"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                        </div>

                        <div class="form-group col-lg-3 mb-3">
                            <label class="text-xs font-semibold" for="margem">Margem</label>
                            <input type="number" name="margem" id="margem" min="0" max="1000000" step="0.01"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs text-right outline-none active:border-none active:outline-green-100 active:ring-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3 mb-3">
                            <label class="text-xs font-semibold" for="telefone">Telefone</label>
                            <input type="text" name="telefone" id="telefone"
                                class="telefone w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            <label class="text-xs font-semibold" for="produto">Produto</label>
                            <input type="text" name="produto" id="produto"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 form-group mb-3">
                            <label class="text-xs font-semibold" for="observacoes">Observações</label>
                            <textarea name="observacoes" id="observacoes" rows="5" class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 w-full">
                        <button type="submit"
                            class="rounded-full bg-teal-700 px-3 py-1 text-sm text-stone-100 transition delay-150 ease-in-out hover:scale-105 hover:bg-teal-800 hover:text-stone-100 hover:shadow-md hover:shadow-black">
                            Salvar Dados
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
