<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="w-75 mx-auto sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.tabela.comissoes.update', $tabela) }}" class="w-50 mx-auto mt-3 flex flex-col gap-3" method="post">
                        @csrf @method('PATCH')
                        <div class="flex flex-col">
                            <label for="descricao" class="text-black">Descrição da Tabela</label>
                            <input type="text" name="descricao" id="descricao" value="{{ old('descricao') ?? $tabela->descricao }}" required
                                class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('descricao')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="financeira_id" class="text-black">Financeira</label>
                            <select type="text" name="financeira_id" id="financeira_id" required
                                class="select2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}" @if ($produto->id == $tabela->produto->id) selected @endif>{{ $produto->descricao_produto }}</option>
                                @endforeach
                            </select>
                            @error('financeira_id')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="financeira_id" class="text-black">Financeira</label>
                            <select type="text" name="financeira_id" id="financeira_id" required
                                class="seelct2 rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                @foreach ($financeiras as $fin)
                                    <option value="{{ $fin->id }}" @if ($fin->id == $tabela->financeira->financeira_id) selected @endif>{{ $fin->nome_financeira }}</option>
                                @endforeach
                            </select>
                            @error('financeira_id')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="correspondente_id" class="text-black">Correspondente</label>
                            <select type="text" name="correspondente_id" id="correspondente_id" required
                                class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                @foreach ($correspondentes as $corr)
                                    <option value="{{ $corr->id }}" @if ($corr->id == $tabela->correspondente->correspondente_id)  @endif>{{ $corr->nome_correspondente }}</option>
                                @endforeach
                            </select>
                            @error('correspondente_id')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="percentual" class="text-black">Percentual</label>
                            <input type="number" name="percentual" id="percentual" value="{{ $fmt->format($tabela->percentual_loja, 2) }}" min="0.000" max="100.000"
                                step="0.001" class="percentual rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('percentual')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <button class="mt-3 rounded-md bg-gray-300 px-6 py-1.5 text-gray-500 transition duration-150 hover:bg-green-700 hover:text-slate-50 hover:shadow-xl">
                            <i class="bi bi-floppy mr-1"></i>
                            Salvar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
