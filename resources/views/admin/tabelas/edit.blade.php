<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="w-75 mx-auto sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.tabelas.update', $tabela) }}" class="mx-auto mt-3 flex w-full flex-col gap-3" method="post">
                        @csrf @method('PATCH')
                        <div class="form-row">
                            <div class="col-6 flex flex-col gap-3">
                                <div class="flex flex-col">
                                    <label for="descricao" class="text-black">Descrição da Tabela</label>
                                    <input type="text" name="descricao" id="descricao" value="{{ $tabela->descricao }}" required
                                        class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label for="codigo" class="text-black">Código</label>
                                    <input type="text" name="codigo" id="codigo" value="{{ $tabela->codigo }}" required
                                        class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label for="organizaca" class="text-black">Órgão</label>
                                    <select type="text" name="organizacao_id" id="orgao_id" required
                                        class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        @foreach ($organizacoes as $organizacao)
                                            <option value="{{ $organizacao->id }}")>{{ $organizacao->nome_organizacao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label for="produto_id" class="text-black">Produto</label>
                                    <select type="text" name="produto_id" id="produto" required
                                        class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}")>{{ $produto->descricao_produto }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label for="financeira" class="text-black">Financeira</label>
                                    <select type="text" name="financeira_id" id="financeira" required
                                        class="seelct2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        @foreach ($financeiras as $fin)
                                            <option value="{{ $fin->id }}">{{ $fin->nome_financeira }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label for="correspondente" class="text-black">Correspondente</label>
                                    <select type="text" name="correspondente_id" id="correspondente" required
                                        class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        @foreach ($correspondentes as $corr)
                                            <option value="{{ $corr->id }}">{{ $corr->nome_correspondente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 flex flex-col gap-3">
                                <div class="flex flex-col">
                                    <label for="percentual_loja class="text-black">% Loja</label>
                                    <input type="number" name="percentual_loja" id="percentual_loja" value="{{ number_format($tabela->percentual_loja, 2) }}" min="0.00"
                                        max="100.00" step="0.01" class="percentual rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label for="percentual_deferido" class="text-black">% Deferido</label>
                                    <input type="number" name="percentual_deferido" id="percentual_deferido" value="{{ number_format($tabela->percentual_deferido, 2) }}"
                                        min="0.00" max="100.00" step="0.01"
                                        class="percentual rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label for="percentual_agente" class="text-black">% Agente</label>
                                    <input type="number" name="percentual_agente" id="percentual_agente" value="{{ number_format($tabela->percentual_agente, 2) }}" min="0.00"
                                        max="100.00" step="0.01" class="percentual rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label for="percentual_corretor" class="text-black">% Corretor</label>
                                    <input type="number" name="percentual_corretor" id="percentual_corretor" value="{{ number_format($tabela->percentual_corretor, 2) }}"
                                        min="0.00" max="100.00" step="0.01"
                                        class="percentual rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label>Gera parcela</label>
                                    <div class="w-100 flex flex-row rounded-lg border p-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="parcelado" id="opt1" value="1"
                                                @if ($tabela->parcelado == 1) checked @endif />
                                            <label class="form-check-label" for="">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="parcelado" id="opt2" value="0"
                                                @if ($tabela->parcelado == 0) checked @endif />
                                            <label class="form-check-label" for="">Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label for="referencia" class="text-black">Referência de Cálculo</label>
                                    <select type="text" name="referencia" id="referencia" required
                                        class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        <option value="B">Bruto</option>
                                        <option value="L">Líquido</option>
                                        <option value="BL">Bruto | Líquido</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="mt-3 rounded-md bg-green-300 px-6 py-1.5 text-gray-500 transition duration-150 hover:bg-green-700 hover:text-slate-50 hover:shadow-xl">
                            <i class="bi bi-floppy mr-1"></i>
                            Atualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
