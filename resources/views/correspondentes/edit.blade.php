<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.correspondentes.update', $correspondente) }}" class="mt-3" method="post">
                        @csrf @method('patch')
                        <div class="flex flex-col">
                            <label for="nome_correspondente" class="text-black">Nome Correspondente</label>
                            <input type="text" name="nome_correspondente" id="nome_correspondente" value="{{ $correspondente->nome_correspondente }}"
                                class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('nome_correspondente')
                                <span class="text-nowrap mb-3 mt-3 rounded-full px-2 py-2 text-sm text-red-500">*{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="nome_responsavel" class="text-black">Nome do Responsável</label>
                            <input type="text" name="nome_responsavel" id="nome_responsavel" value="{{ $correspondente->nome_responsavel }}"
                                class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('nome_responsavel')
                                <span class="text-nowrap mb-3 mt-3 rounded-full px-2 py-2 text-sm text-red-500">*{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="phone_contato" class="text-black">Tel. Contato</label>
                            <input type="text" name="phone_contato" id="phone_contato" value="{{ $correspondente->phone_contato }}"
                                class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('phone_contato')
                                <span class="text-nowrap mb-3 mt-3 rounded-full px-2 py-2 text-sm text-red-500">*{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="cpf_cnpj" class="text-black">CPF ou CNPJ</label>
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="{{ $correspondente->cpf_cnpj }}"
                                class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('cpf_cnpj')
                                <span class="text-nowrap mb-3 mt-3 rounded-full px-2 py-2 text-sm text-red-500">*{{ $message }}. Tecle [F5]</span>
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
