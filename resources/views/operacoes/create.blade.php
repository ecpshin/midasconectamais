<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.operacoes.create') }}" class="mt-3" method="post">
                        @csrf
                        <div class="flex flex-col">
                            <label for="descricao_operacao" class="text-black">Descrição da Operação</label>
                            <input type="text" name="descricao_operacao" id="descricao_operacao" value="{{ old('descricao_operacao') }}"
                                class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('descricao_operacao')
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
