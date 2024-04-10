<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.propostas.update', $proposta) }}" method="post">
                @csrf @method('PATCH')
                <fieldset class="mb-3 flex gap-8 rounded bg-slate-100 px-6 py-6 shadow-sm shadow-slate-500">
                    <div class="flex w-1/12 flex-col gap-1">
                        <label class="text-sm font-semibold">
                            <i class="bi bi-person-check"></i>ID
                        </label>
                        <input type="text" name="cliente_id" value="{{ $proposta->cliente->id }}" readonly
                            class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="cliente_id">
                    </div>
                    <div class="flex w-2/12 flex-col gap-1">
                        <label class="text-sm font-semibold" for="cpf">CPF</label>
                        <input type="text" value="{{ $proposta->cliente->cpf }}"
                            class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="cpf">
                    </div>
                    <div class="flex w-3/6 flex-col gap-1">
                        <label class="text-sm font-semibold" for="nome_cliente">Nome</label>
                        <input type="text" value="{{ $proposta->cliente->nome }}" readonly
                            class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="nome_cliente">
                    </div>
                </fieldset>
                <fieldset class="mb-3 flex flex-col gap-8 rounded bg-slate-100 p-6 shadow-sm shadow-slate-500">
                    <div class="row flex flex-wrap justify-between gap-8">
                        <div class="flex w-full flex-col gap-1 lg:w-4/12">
                            <label class="text-sm font-semibold">Controle</label>
                            <input type="text" name="uuid" value="{{ $proposta->uuid }}" readonly
                                class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="uuid">
                        </div>
                        <div class="flex w-full flex-col gap-1 lg:w-3/12">
                            <label class="text-sm font-semibold" for="numero_contrato">Nº Contrato</label>
                            <input type="text" name="numero_contrato" value="{{ $proposta->numero_contrato }}" onblur="fn(this)"
                                class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="numero_contrato">
                        </div>
                    </div>
                    <div class="flex w-full flex-row flex-wrap justify-between">
                        <div class="flex w-full flex-col gap-1 lg:w-2/12">
                            <label class="text-sm font-semibold" for="data_digitacao">Digitado</label>
                            <input type="date" name="data_digitacao" value="{{ $proposta->data_digitacao->format('Y-m-d') }}"
                                class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="data_digitacao">
                        </div>
                        <div class="flex w-full flex-col gap-1 lg:w-2/12">
                            <label class="text-sm font-semibold" for="data_pagamento">Pago</label>
                            <input type="date" name="data_pagamento" value="{{ $proposta->data_pagamento->format('Y-m-d') ?? '' }}"
                                class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="data_pagamento">
                        </div>
                        <div class="flex w-full flex-col gap-1 lg:w-1/12">
                            <label class="text-sm font-semibold" for="prazo">Prazo</label>
                            <input type="number" name="prazo_proposta" value="{{ $proposta->prazo_proposta }}"
                                class="tab-0 flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="prazo">
                        </div>
                        <div class="flex w-full flex-col gap-1 lg:w-2/12">
                            <label class="text-sm font-semibold" for="total_proposta">Total</label>
                            <input type="text" name="total_proposta" value="{{ $proposta->total_proposta }}"
                                class="tab-0 flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                id="total_proposta">
                        </div>
                        <div class="flex w-full flex-col gap-1 lg:w-2/12">
                            <label class="text-sm font-semibold" for="parcela_proposta">Parcela</label>
                            <input type="text" name="parcela_proposta" value="{{ $proposta->parcela_proposta }}"
                                class="tab-0 flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                id="parcela_proposta">
                        </div>
                        <div class="flex w-full flex-col gap-1 lg:w-2/12">
                            <label class="text-sm font-semibold" for="liquido_proposta">Líquido</label>
                            <input type="text" name="liquido_proposta" value="{{ $proposta->liquido_proposta }}"
                                class="tab-0 flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                id="liquido_proposta">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="flex flex-col gap-8 rounded bg-slate-100 p-6 shadow-sm shadow-slate-500">
                    <div class="flex w-full flex-row flex-wrap justify-between gap-3">
                        <div class="flex flex-col gap-1">
                            <label class="font-semibold" for="situacao_id">Situação</label>
                            <select name="situacao_id" id="situacao_id"
                                class="select2 mt-2 border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($situacoes as $situacao)
                                    <option value="{{ $situacao->id }}" @if ($proposta->situacao->id == $situacao->id) seleted @endif>{{ $situacao->descricao_situacao }}</option>
                                @empty
                                    <option value="">Não há situação cadastrada</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="font-semibold" for="operacao_id">Operação</label>
                            <select name="operacao_id" id="operacao_id"
                                class="select2 mt-2 border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($operacoes as $op)
                                    <option value="{{ $op->id }}" @if ($proposta->operacao->id == $op->id) selected @endif>{{ $op->descricao_operacao }}</option>
                                @empty
                                    Não há Operações
                                @endforelse
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="font-semibold" for="financeira_id">Financeiras</label>
                            <select name="financeira_id" id="financeira_id"
                                class="select2 mt-2 border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($financeiras as $fin)
                                    <option value="{{ $fin->id }}" @if ($proposta->financeira->id == $fin->id) selected @endif>{{ $fin->nome_financeira }}</option>
                                @empty
                                    <option>Não ha financeiras</option>
                                @endforelse

                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="font-semibold" for="correspondente_id">Correspondente</label>
                            <select name="correspondente_id" id="correspondente_id"
                                class="select2 mt-2 border-gray-300 py-1 text-base focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($correspondentes as $corr)
                                    <option value="{{ $corr->id }}" @if ($proposta->correspondente->id == $corr->id) seleted @endif>{{ $corr->nome_correspondente }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </fieldset>
                @can('create comissao')
                    <fieldset class="flex flex-col gap-8 rounded bg-slate-100 p-6 shadow-sm shadow-slate-500">
                        <div class="flex flex-row gap-3">
                            <div class="flex flex-col gap-1">
                                <label class="text-sm font-semibold">Tabela</label>
                                <input type="text" name="tabela_comissao" value="{{ $proposta->comissao->tabela_comissao }}"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0" id="tabela_comissao">
                            </div>
                            <div class="flex w-full flex-col gap-1 lg:w-1/12">
                                <label class="text-sm font-semibold" for="percentual_loja">% Loja</label>
                                <input type="text" name="percentual_loja" value="{{ number_format($proposta->comissao->percentual_loja, 2) }}"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                    id="percentual_loja">
                            </div>
                            <div class="flex w-full flex-col gap-1 lg:w-2/12">
                                <label class="text-sm font-semibold">R$ Loja</label>
                                <input type="text" name="valor_loja" value="{{ number_format($proposta->comissao->valor_loja, 2) }}"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="valor_loja">
                            </div>
                            <div class="flex w-full flex-col gap-1 lg:w-1/12">
                                <label class="text-sm font-semibold">% Operador</label>
                                <input type="text" name="percentual_operador" value="{{ number_format($proposta->comissao->percentual_operador, 2) }}"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                    id="percentual_operador">
                            </div>
                            <div class="flex w-full flex-col gap-1 lg:w-2/12">
                                <label class="text-sm font-semibold">R$ Operador</label>
                                <input type="text" name="valor_operador" value="{{ number_format($proposta->comissao->valor_operador, 2) }}"
                                    class="flex-1 rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0" id="valor_operador">
                            </div>
                        </div>
                    </fieldset>
                @endcan
                <div class="px-3 py-2">
                    <button type="submit"
                        class="rounded-lg bg-emerald-500 px-6 py-1.5 text-gray-100 transition duration-150 hover:bg-emerald-800 hover:text-slate-50 hover:shadow-xl">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-midas-layout>
