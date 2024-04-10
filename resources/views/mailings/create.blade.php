<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <div class="custom-scrollbar mb-12 overflow-x-scroll rounded-lg bg-white px-8 py-6">
                        <form action="{{ route('admin.mailings.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-row items-center">
                                <label for="mailing" class="text-nowrap font-semibold">Carregar arquivo</label>
                                <input type="file" name="mailing" id="mailing" value="" accept=".xls, .xlsx"
                                    class="w-full rounded-lg border-gray-400 bg-slate-100 px-3 py-2">
                            </div>
                            <div>
                                <button type="submit" class="rounded-full bg-emerald-700 px-3 py-2 text-xs text-white">Carregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
