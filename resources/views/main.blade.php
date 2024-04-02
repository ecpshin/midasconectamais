<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-700">
                    <h4>Seja bem-vindo(a)! {{ Auth::user()->name }} </h4>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
