<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="mx-auto mb-3 max-w-4xl overflow-hidden bg-white px-7 py-4 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.comissoes.update', $comissao) }}" method="post">
                @csrf @method('PATCH')
                <fieldset class="mb-2 flex flex-col gap-5 rounded bg-slate-50 px-7 py-3 text-xs shadow-md shadow-slate-500">
                    <div class="row flex flex-row">
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold">ID</label>
                            <span id="cliente" class="truncate rounded-lg border-b border-slate-500 px-3 py-1">{{ substr(sha1($comissao->proposta->cliente->id), 0, 8) }}</span>
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label class="font-semibold">CPF</label>
                            <span class="rounded-lg border-b border-slate-500 px-3 py-1">{{ substr($comissao->proposta->cliente->cpf, 0, 4) . '***.***-**' }}</span>
                        </div>
                        <div class="col-lg-7 mb-3 flex flex-col">
                            <label class="font-semibold">Nome</label>
                            <span class="rounded-lg border-b border-slate-500 px-3 py-1">{{ $comissao->proposta->cliente->nome }}</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="mb-2 flex flex-col gap-5 rounded bg-slate-50 px-7 py-3 text-xs shadow-md shadow-slate-500">
                    <div class="row flex flex-row justify-between">
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold">Controle</label>
                            <span class="flex-1 rounded-lg border-b border-gray-500 px-3 py-1" id="uuid">
                                {{ $comissao->proposta->uuid }}
                            </span>
                        </div>
                        <div class="col-lg-2 mb-3 flex w-full flex-col">
                            <label class="font-semibold" for="numero_contrato">Nº Contrato</label>
                            <span class="rounded-lg border-b border-gray-500 px-3 py-1" id="numero_contrato">
                                {{ $comissao->proposta->numero_contrato }}
                            </span>
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold" for="data_digitacao">Digitado</label>
                            <span class="w-100 border-b border-gray-400 px-3 py-1 text-center" id="data_digitacao">
                                {{ $comissao->proposta->data_digitacao->format('d/m/Y') }}
                            </span>
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold" for="data_pagamento">Pago</label>
                            <span class="w-100 border-b border-gray-400 px-3 py-1 text-center" id="data_pagamento">
                                {{ $comissao->proposta->data_pagamento->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="row flex flex-row justify-between">
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold" for="prazo">Prazo</label>
                            <input type="number" name="prazo_proposta" value="{{ $comissao->proposta->prazo_proposta }}" min='0' step="1" max="999"
                                class="rounded-lg border-gray-300 bg-white px-3 py-1 text-right text-xs focus:border-gray-300 focus:outline-none focus:ring-0" id="prazo">
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label class="font-semibold" for="total_proposta">Total</label>
                            <input type="number" name="total_proposta" value="{{ $comissao->proposta->total_proposta }}" step="0.01" min="0.00" max="1000000.00"
                                class="rounded-lg border-gray-300 bg-white px-3 py-1 text-right text-xs focus:border-gray-300 focus:outline-none focus:ring-0" id="total_proposta">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold" for="parcela_proposta">Parcela</label>
                            <input type="number" name="parcela_proposta" value="{{ $comissao->proposta->parcela_proposta }}" step="0.01" min="0.00" max="1000000.00"
                                class="rounded-lg border-gray-300 bg-white px-3 py-1 text-right text-xs focus:border-gray-300 focus:outline-none focus:ring-0"
                                id="parcela_proposta">
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label class="font-semibold" for="liquido_proposta">Líquido</label>
                            <input type="number" name="liquido_proposta" value="{{ $comissao->proposta->liquido_proposta }}" step="0.01" min="0.00" max="1000000.00"
                                class="rounded-lg border-gray-300 bg-white px-3 py-1 text-right text-xs focus:border-gray-300 focus:outline-none focus:ring-0"
                                id="liquido_proposta">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label>...</label>
                            <input type="text" size="5" value="{{ $comissao->tabela->referencia }}" id="referencia"
                                class="w-10 rounded-lg border-gray-300 bg-white py-1 text-right text-xs text-slate-50" @readonly(true)>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="mb-2 flex flex-col gap-3 rounded bg-slate-50 px-7 py-3 text-xs shadow-md shadow-slate-500">
                    <div class="flex flex-col">
                        <div class="row flex flex-row justify-start">
                            <div class="col-lg-4 mb-3 flex flex-col" @disabled(true)>
                                <label class="font-semibold">Tabela</label>
                                <select name="tabela_id" id="tabela_id" class="form-select rounded-lg border-gray-300 text-xs">
                                    <option value="{{ $comissao->tabela->id }}" selected>
                                        {{ $comissao->tabela->descricao . ' | ' . $comissao->tabela->codigo . ' | ' . $comissao->tabela->financeira->nome_financeira . ' | ' . $comissao->tabela->correspondente->nome_correspondente }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-2 mb-3 flex flex-col text-xs">
                                <label class="font-semibold" for="situacao_id">Situação</label>
                                <select name="situacao_id" id="situacao_id" class="form-select rounded-lg border-gray-300 text-xs">
                                    <option value="{{ $comissao->proposta->situacao_id }}" selected>{{ $comissao->proposta->situacao->descricao_situacao }}</option>
                                </select>
                            </div>
                            <div class="col-lg-2 mb-3 flex flex-col text-xs">
                                <label class="font-semibold" for="produto_id">Produto</label>
                                <select name="produto_id" id="produto_id" class="form-select rounded-lg border-gray-300 text-xs">
                                    <option value="{{ $comissao->tabela->produto->id }}">{{ $comissao->tabela->produto->descricao_produto }}</option>
                                </select>
                            </div>
                            <div class="col-lg-2 mb-3 flex flex-col text-xs">
                                <label class="font-semibold" for="financeira_id">Financeiras</label>
                                <select name="financeira_id" id="financeira_id" class="form-select rounded-lg border-gray-300 text-xs">
                                    <option value="{{ $comissao->tabela->financeira->id }}">{{ $comissao->tabela->financeira->nome_financeira }}</option>
                                </select>
                            </div>
                            <div class="col-lg-2 mb-3 flex flex-col text-xs">
                                <label class="font-semibold" for="correspondente_id">Correspondente</label>
                                <select name="correspondente_id" id="correspondente_id" class="form-select rounded-lg border-gray-300 text-xs">
                                    <option value="{{ $comissao->tabela->correspondente->id }}">{{ $comissao->tabela->correspondente->nome_correspondente }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row flex flex-row justify-start">
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold" for="percentual_loja">% Loja</label>
                            <input type="number" name="percentual_loja" value="{{ $comissao->percentual_loja }}" step="0.01" min="0.00" max="100.00"
                                class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0" id="perc_loja">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold">Valor Loja</label>
                            <input type="number" name="valor_loja" value="{{ $comissao->valor_loja }}" id="val_loja"step="0.01" min="0.00" max="1000000.00"
                                class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0" id="valor_loja">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold">% Agente</label>
                            <input type="number" name="percentual_agente" value="{{ $comissao->percentual_agente }}" step="0.01" min="0.00" max="100.00"
                                class="valor rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0" id="perc_agente">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold">Valor Agente</label>
                            <input type="number" name="valor_agente" value="{{ $comissao->valor_agente }}" step="0.01" min="0.00" max="1000000.00"
                                class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0" id="val_agente">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold">% Corretor</label>
                            <input type="number" name="percentual_corretor" value="{{ $comissao->percentual_corretor }}" step="0.01" min="0.00" max="100.00"
                                class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0" id="perc_corretor">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label class="font-semibold">Valor Corretor</label>
                            <input type="number" name="valor_corretor" value="{{ $comissao->valor_corretor }}" id="val_corretor" step="0.01" min="0.00"
                                max="1000000.00" class="rounded-lg border border-gray-400 text-right text-xs focus:border-gray-400 focus:outline-none focus:ring-0"
                                id="val_corretor">
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
