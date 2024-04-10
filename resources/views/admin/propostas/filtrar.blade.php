<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <!-- start::Advance Table Manage Icons -->
                    <a href="{{ route('admin.propostas.create') }}" class="rounded-md bg-emerald-900 px-3 py-2 text-sm text-white shadow-md shadow-emerald-950 hover:bg-emerald-600">
                        <i class="bi bi-plus-circle"></i>&nbsp;
                        Lançar
                    </a>
                    <form action="{{ route('admin.propostas.aplicar_filtro_por_data') }}" method="POST">
                        @csrf
                        <fieldset class="mt-3 flex flex-row">
                            <input type="date" name="inicio" id="inicio"
                                class="mr-2 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            <input type="date" name="final" id="final"
                                class="mr-2 rounded-lg border-gray-300 bg-white px-3 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            <button tye="submit" class="rounded-md bg-sky-800 px-3 py-2 text-sm text-white shadow-md shadow-emerald-950 hover:bg-sky-500">Filtrar</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
