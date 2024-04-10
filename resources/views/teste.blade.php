<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full rounded-lg bg-white px-5 py-4">
        <h1>Ok</h1>
        <div class="mb-3 flex flex-col">
            <label class="text-sm font-semibold text-slate-500" for="tabela_id">Tabela</label>
            <select name="tabela_id" id="tabela_id" class="rounded-lg border-gray-300 py-1 text-xs">
                @foreach ($tabelas as $tb)
                    <option value="{{ $tb->id }}">{{ $tb->descricao }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 flex flex-col">
            <label class="text-sm font-semibold text-slate-500" for="financeira_id">Financeiras</label>
            <select name="financeira_id" id="financeira_id" class="rounded-lg border-gray-300 py-1 text-xs">
                @foreach ($financeiras as $fin)
                    <option value="{{ $fin->id }}">{{ $fin->nome_financeira }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 flex flex-col">
            <label class="text-sm font-semibold text-slate-500" for="correspondente_id">Correspondente</label>
            <select name="correspondente_id" id="correspondente_id" class="rounded-lg border-gray-300 py-1 text-xs">
                @foreach ($correspondentes as $corr)
                    <option value="{{ $corr->id }}">{{ $corr->nome_correspondente }}</option>
                @endforeach
            </select>
        </div>
    </div>
</x-midas-layout>
