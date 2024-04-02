<x-midas-layout>
    <x-slot name="header">
        <x-bread :area="$area" :page="$page" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="gap-3 px-8 py-6 text-gray-900">
                    <fieldset class="mb-5 flex flex-col" disabled>
                        <label class="font-semibold text-black">Descrição da Situação</label>
                        <input class="mt-2 rounded-lg border-gray-300 py-1" placeholder="{{ $situacao->descricao_situacao }}">
                    </fieldset>

                    <a href="{{ route('admin.situacoes.index') }}"
                        class="mt-3 w-16 rounded-md bg-orange-500 px-6 py-2 text-center font-semibold text-gray-800 transition duration-150 hover:bg-orange-400 hover:text-slate-50 hover:shadow-xl">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
