<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page ?? '' }}" area="{{ $area ?? '' }}" rota="{{ $rota ?? '' }}"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="mt-3 rounded-lg bg-white px-8 py-5 shadow-md">
                <fieldset disabled class="mb-3 flex flex-col rounded-lg p-4 text-sm outline outline-1 outline-red-500">
                    <h3 class="rounded-lg bg-slate-700 py-2 text-center text-lg text-slate-50">Dados Pessoais</h3>
                    <div class="mt-3 w-full rounded-lg border border-slate-300 px-5 py-4">
                        <div class="grid gap-3 lg:grid-cols-12">
                            <div class="my-3 flex flex-col sm:col-span-12 lg:col-span-8">
                                <label class="font-semibold">Nome Completo</label>
                                <span class="mt-1 flex-1 rounded border border-gray-300 px-2 py-2 text-sm">{{ $cliente->nome }}</span>
                            </div>
                            <div class="my-3 flex flex-col lg:col-span-2">
                                <label class="font-semibold">CPF</label>
                                <span class="mt-1 flex-auto rounded border border-gray-300 px-2 py-2 text-sm">{{ $cliente->cpf }}</span>
                            </div>
                            <div class="my-3 flex flex-col lg:col-span-2">
                                <label class="font-semibold">Data Nasc.</label>
                                <span
                                    class="mt-1 flex-auto rounded border border-gray-300 px-2 py-2 text-sm">{{ !$cliente->data_nascimento ? date('Y-m-d') : $cliente->data_nascimento->format('Y-m-d') }}</span>
                            </div>
                        </div>
                        <div class="grid gap-3 lg:grid-cols-12">
                            <div class="my-3 flex flex-col lg:col-span-5">
                                <label class="font-semibold">RG</label>
                                <span class="mt-1 flex-1 rounded border border-gray-300 px-2 py-2 text-sm">{{ $cliente->rg }}</span>
                            </div>
                            <div class="my-3 flex flex-col lg:col-span-2">
                                <label class="font-semibold">Órgão Exp</label>
                                <span class="mt-1 flex-1 rounded border border-gray-300 px-2 py-2 text-sm">{{ $cliente->orgao_exp }}</span>
                            </div>
                            <div class="my-3 flex flex-col lg:col-span-2">
                                <label class="font-semibold">Data Exp.</label>
                                <span
                                    class="mt-1 flex-1 rounded border border-gray-300 px-2 py-2 text-sm">{{ !$cliente->data_exp ? date('Y-m-d') : $cliente->data_exp->format('Y-m-d') }}</span>
                            </div>
                            <div class="my-3 flex flex-col lg:col-span-3">
                                <label class="font-semibold">Naturalidade</label>
                                <span class="mt-1 flex-1 rounded border border-gray-300 px-2 py-2 text-sm">{{ $cliente->naturalidade }}</span>
                            </div>
                        </div>
                        <div class="grid gap-5 lg:grid-cols-4">
                            <div class="my-3 flex flex-col">
                                <label class="font-semibold">Nome da Mãe</label>
                                <span class="mt-1 flex-1 rounded border border-gray-300 px-2 py-2 text-sm">{{ $cliente->genitora }}</span>
                            </div>
                            <div class="my-3 flex flex-col">
                                <label class="font-semibold">Nome do Pai</label>
                                <span class="mt-1 flex-1 rounded border border-gray-300 px-2 py-2 text-sm">{{ $cliente->genitor }}</span>
                            </div>
                            <div class="my-3 flex flex-col">
                                <label class="font-semibold">Sexo</label>
                                <span class="mt-2 rounded-lg border border-gray-300 px-2 py-2 text-sm">{{ $cliente->sexo }}</span>
                            </div>
                            <div class="my-3 flex flex-col">
                                <label class="font-semibold">Estado Civil</label>
                                <span class="mt-2 rounded-lg border border-gray-300 px-2 py-2 text-sm">{{ $cliente->estado_civil }}</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div> {{-- Propostas do cliente --}}
            <div class="mt-3 overflow-x-auto rounded-lg bg-white px-8 py-5 shadow-md">
                <h1 class="w-100 mb-3 text-center text-xl">Propostas Realizadas</h1>
                <table class="w-100 border">
                    <thead>
                        <tr>
                            <th class="p-2 pl-2 pr-2 text-xs">#</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Data</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Nº Contrato</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Operação</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Prazo</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Total</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Parcela</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Líquido</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Financeira</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Correspondente</th>
                            <th class="p-2 pl-2 pr-2 text-xs">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cliente->propostas as $proposta)
                            <tr class="odd:bg-slate-200">
                                <td class="text-ellipsis p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->id }}</td>
                                <td class="text-ellipsis p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->created_at->format('d/m/y') }}</td>
                                <td class="text-ellipsis p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->numero_contrato ?? 'Não informado' }}
                                </td>
                                <td class="text-nowrap text-ellipsis p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->operacao->descricao_operacao }}</td>
                                <td class="text-nowrap text-ellipsis p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->prazo_proposta }}</td>
                                <td class="text-nowrap text-ellipsis p-1 pl-2 pr-2 text-right text-xs font-medium">
                                    {{ $fmt->format($proposta->total_proposta) }}</td>
                                <td class="text-nowrap w-[100px] overflow-hidden text-ellipsis p-1 pl-2 pr-2 text-right text-xs font-medium">
                                    {{ $fmt->format($proposta->parcela_proposta) }}
                                </td>
                                <td class="text-nowrap max-w-[100px] overflow-hidden p-1 pl-2 pr-2 text-right text-xs font-medium">{{ $fmt->format($proposta->liquido_proposta) }}
                                </td>
                                <td class="text-nowrap max-w-[100px] overflow-hidden p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->financeira->nome_financeira }}</td>
                                <td class="text-nowrap max-w-[100px] overflow-hidden p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->correspondente->nome_correspondente }}</td>
                                <td class="text-nowrap max-w-[100px] overflow-hidden p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->situacao->descricao_situacao }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">Não há proposta(s) cadastradas deste cliente</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-midas-layout>
