<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.tabelas.store') }}" class="w-75 mx-auto mt-3 flex flex-col gap-3" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 flex flex-col gap-3">
                                <div class="flex flex-col">
                                    <label for="descricao" class="text-black">Descrição</label>
                                    <input type="text" name="descricao" id="descricao" value="{{ old('descricao') }}" required
                                        class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label for="codigo" class="text-black">Código</label>
                                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" required
                                        class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-black">Órgão</label>
                                    <select type="text" name="organizacao_id" id="orgao_id" required
                                        class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        @foreach ($orgaos as $orgao)
                                            <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label for="produto" class="text-black">Produto</label>
                                    <select type="text" name="produto_id" id="produto" required
                                        class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->descricao_produto }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label for="financeira" class="text-black">Financeira</label>
                                    <select type="text" name="financeira_id" id="financeira" required
                                        class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        <option value="">Selecione</option>
                                        @foreach ($financeiras as $fin)
                                            <option value="{{ $fin->id }}">{{ $fin->nome_financeira }}</option>
                                        @endforeach
                                    </select>
                                    @error('financeira_id')
                                        <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col">
                                    <label for="correspondente" class="text-black">Correspondente</label>
                                    <select type="text" name="correspondente_id" id="correspondente" required
                                        class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                        <option value="">Selecione</option>
                                        @foreach ($correspondentes as $corr)
                                            <option value="{{ $corr->id }}">{{ $corr->nome_correspondente }}</option>
                                        @endforeach
                                    </select>
                                    @error('correspondente_id')
                                        <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 flex flex-col gap-3">
                                <div class="flex flex-col">
                                    <label for="percentual_loja" class="text-black">% Loja</label>
                                    <input type="number" name="percentual_loja" id="percentual_loja" value="{{ old('percentual_loja') }}" min="0.00" max="100.00"
                                        step="0.01" class="percentual rounded border-gray-300 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-row justify-between">
                                    <div class="flex flex-col">
                                        <label for="percentual_diferido" class="text-black">% Diferido</label>
                                        <input type="number" name="percentual_diferido" id="percentual_diferido" value="{{ old('percentual_diferido') }}" min="0.00"
                                            max="100.00" step="0.01"
                                            class="percentual rounded border-gray-300 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0">
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="prazo" class="text-black">Prazo</label>
                                        <input type="number" name="prazo" id="prazo" value="{{ old('prazo') }}" min="0.00" max="999" step="1"
                                            class="rounded border-gray-300 py-1 text-right focus:border-gray-300 focus:outline-none focus:ring-0">
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="referencia" class="text-black">Referência de Cálculo</label>
                                        <select type="text" name="referencia" id="referencia" required
                                            class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                            <option value="B">Bruto</option>
                                            <option value="L" selected>Líquido</option>
                                            <option value="BL">Bruto|Líquido</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label for="percentual_agente" class="text-black">% Agente</label>
                                    <input type="number" name="percentual_agente" id="percentual_agente" value="{{ old('percentual_agente') }}" min="0.00"
                                        max="100.00" step="0.01" class="percentual rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label for="percentual_corretor" class="text-black">% Corretor</label>
                                    <input type="number" name="percentual_corretor" id="percentual_corretor" value="{{ old('percentual_corretor') }}" min="0.00"
                                        max="100.00" step="0.01" class="percentual rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                </div>
                                <div class="flex flex-col">
                                    <label>Gera parcela</label>
                                    <div class="flex flex-row justify-around rounded-lg border px-3 py-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="parcelado" id="opt1" value="1" />
                                            <label class="form-check-label" for="">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="parcelado" id="opt2" value="0" checked />
                                            <label class="form-check-label">Não</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button
                                class="mt-3 rounded-md bg-emerald-300 px-6 py-1.5 text-gray-500 transition duration-150 hover:bg-green-700 hover:text-slate-50 hover:shadow-xl">
                                <i class="bi bi-floppy mr-1"></i>
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
