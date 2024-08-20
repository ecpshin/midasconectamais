<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-700">
                    <h4>Seja bem-vindo(a)! {{ Auth::user()->name }}</h4>
                    <x-card>
                        <h6>Você tem {{ $count > 0 ? 'Não possui' : $count }} agendamentos. <a href="{{ route('admin.calls.agendados') }}">Clique e para acessar os
                                agendamentos</a></h6>
                    </x-card>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
