<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page ?? '' }}" area="{{ $area ?? '' }}" rota="{{ $rota ?? '' }}"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            Cliente Propfile
        </div>
    </div>
</x-midas-layout>
