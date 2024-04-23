<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.comissoes.update', $comissao) }}" method="post">
                @csrf
                <fieldset class="mb-2 text-xs flex flex-row rounded bg-slate-50 px-7 py-3 shadow-md shadow-slate-500">
                    <div class="flex flex-col col-lg-2 gap-1">
                        <label class="font-semibold">
                            <i class="bi bi-person-check"></i> ID
                        </label>
                        <span id="cliente"
                              class="rounded-lg border-b border-slate-500 px-3 py-1 truncate">{{ sha1($comissao->proposta->cliente->id) }}</span>
                    </div>
                    <div class="flex flex-col col-lg-3 gap-1">
                        <label class="font-semibold">CPF</label>
                        <span class="rounded-lg border-b border-slate-500 px-3 py-1">***.***.***-**"</span>
                    </div>
                    <div class="flex flex-col col-lg-7 gap-1">
                        <label class="font-semibold">Nome</label>
                        <span class="rounded-lg border-b border-slate-500 px-3 py-1">{{ $comissao->proposta->cliente->nome }}</span>
                    </div>
                </fieldset>
                <fieldset
                        class="mb-2 text-xs flex flex-col rounded bg-slate-50 px-7 py-3 shadow-md shadow-slate-500 gap-5">
                    <div class="row justify-content-between">
                        <div class="flex flex-col gap-1 col-lg-2">
                            <label class="font-semibold">Controle</label>
                            <span class="flex-1 rounded-lg border-b border-gray-500 px-3 py-1" id="uuid">
                                {{ $comissao->proposta->uuid }}
                            </span>
                        </div>
                        <div class="flex w-full flex-col gap-1 col-lg-2">
                            <label class="font-semibold" for="numero_contrato">Nº Contrato</label>
                            <span class="rounded-lg border-b border-gray-500 px-3 py-1" id="numero_contrato">
                                {{ $comissao->proposta->numero_contrato }}
                            </span>
                        </div>
                        <div class="flex flex-col gap-1 col-lg-2">
                            <label class="font-semibold" for="data_digitacao">Digitado</label>
                            <span class="w-100 text-center border-b border-gray-400 px-3 py-1" id="data_digitacao">
                                {{ $comissao->proposta->data_digitacao->format('Y-m-d') }}
                            </span>
                        </div>
                        <div class="flex flex-col gap-1 col-lg-2">
                            <label class="font-semibold" for="data_pagamento">Pago</label>
                            <span class="w-100 text-center border-b border-gray-400 px-3 py-1" id="data_pagamento">
                                {{ $comissao->proposta->data_pagamento->format('Y-m-d') }}
                            </span>
                        </div>
                    </div>
                    <div class="row justify-between gap-3">
                        <div class="flex flex-col gap-1 col-lg-2">
                            <label class="font-semibold" for="prazo">Prazo</label>
                            <input type="number" name="prazo_proposta" value="{{ $comissao->proposta->prazo_proposta }}"
                                   class="text-xs rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                   id="prazo">
                        </div>
                        <div class="flex flex-col gap-1 col-lg-2">
                            <label class="font-semibold" for="total_proposta">Total</label>
                            <input type="text" name="total_proposta" value="{{ $comissao->proposta->total_proposta }}"
                                   class="text-xs rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                   id="total_proposta">
                        </div>
                        <div class="flex flex-col gap-1 col-lg-2">
                            <label class="font-semibold" for="parcela_proposta">Parcela</label>
                            <input type="text" name="parcela_proposta"
                                   value="{{ $comissao->proposta->parcela_proposta }}"
                                   class="text-xs rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                   id="parcela_proposta">
                        </div>
                        <div class="flex flex-col gap-1 col-lg-2">
                            <label class="font-semibold" for="liquido_proposta">Líquido</label>
                            <input type="text" name="liquido_proposta"
                                   value="{{ $comissao->proposta->liquido_proposta }}"
                                   class="text-xs rounded-lg border-gray-300 bg-white px-3 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0"
                                   id="liquido_proposta">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="mb-2 text-xs flex flex-col rounded bg-slate-50 px-7 py-3 shadow-md shadow-slate-500 gap-3">
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-row justify-start">
                            <div class="flex flex-col col-lg-4">
                                <label class="font-semibold">Tabela</label>
                                <select name="tabela_id" id="tabela_id" class="w-full select2" readonly="true">
                                    <option value="{{  $comissao->tabela->id }}">
                                        {{  $comissao->tabela->descricao .' > '. $comissao->tabela->codigo .' > ' . $comissao->tabela->financeira->nome_financeira . ' > ' . $comissao->tabela->correspondente->nome_correspondente }}
                                    </option>
                                </select>
                            </div>
                            <div class=" text-xs flex flex-col col-lg-2">
                                <label class="font-semibold" for="situacao_id">Situação</label>
                                <select name="situacao_id" id="situacao_id" class="flex-1 select2">
                                    <option value="{{ $comissao->proposta->situacao_id }}"
                                            selected>{{ $comissao->proposta->situacao->descricao_situacao }}</option>
                                </select>
                            </div>
                            <div class=" text-xs flex flex-col col-lg-2">
                                <label class="font-semibold" for="produto_id">Produto</label>
                                <select name="produto_id" id="produto_id" class="min-w-[125px] select2">
                                    <option value="{{ $comissao->tabela->produto->id }}">{{ $comissao->tabela->produto->descricao_produto }}</option>
                                </select>
                            </div>
                            <div class=" text-xs flex flex-col col-lg-2">
                                <label class="font-semibold" for="financeira_id">Financeiras</label>
                                <select name="financeira_id" id="financeira_id" class="select2">
                                    <option value="{{ $comissao->tabela->financeira->id }}">{{ $comissao->tabela->financeira->nome_financeira }}</option>
                                </select>
                            </div>
                            <div class=" text-xs flex flex-col col=lg-2">
                                <label class="font-semibold" for="correspondente_id">Correspondente</label>
                                <select name="correspondente_id" id="correspondente_id" class="min-w-[125px] select2">
                                    <option value="{{ $comissao->tabela->correspondente->id }}">{{ $comissao->tabela->correspondente->nome_correspondente }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-start">
                            <div class="flex flex-col col-lg-2">
                                <label class="font-semibold" for="percentual_loja">% Loja</label>
                                <input type="number" name="percentual_loja" value="{{ $comissao->percentual_loja }}"
                                       class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0"
                                       id="percentual_loja">
                            </div>
                            <div class="col-lg-2 flex flex-col">
                                <label class="font-semibold">Valor Loja</label>
                                <input type="number" name="valor_loja" value="{{ $comissao->valor_loja }}"
                                       class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0"
                                       id="valor_loja">
                            </div>
                            <div class="col-lg-2 flex flex-col">
                                <label class="font-semibold">% Agente</label>
                                <input type="number" name="percentual_agente" value="{{ $comissao->percentual_agente }}"
                                       class="valor rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0"
                                       id="percentual_agente">
                            </div>
                            <div class="col-lg-2 flex flex-col">
                                <label class="font-semibold">Valor Agente</label>
                                <input type="number" name="valor_agente" value="{{ $comissao->valor_agente }}"
                                       class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0"
                                       id="valor_agente">
                            </div>
                            <div class="col-lg-2 flex flex-col">
                                <label class="font-semibold">% Corretor</label>
                                <input type="number" name="percentual_corretor"
                                       value="{{ $comissao->percentual_corretor }}"
                                       class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0"
                                       id="percentual_corretor">
                            </div>
                            <div class="col-lg-2 flex flex-col">
                                <label class="font-semibold">Valor Corretor</label>
                                <input type="number" name="valor_corretor" value="{{ $comissao->valor_corretor }}"
                                       class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0"
                                       id="valor_corretor">
                            </div>
                        </div>

                </fieldset>
                <div class="px-3 py-2">
                    <button type="submit"
                            class="rounded-lg bg-emerald-500 px-6 py-1.5 text-gray-100 transition duration-150 hover:bg-emerald-800 hover:text-slate-50 hover:shadow-xl">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-midas-layout>
