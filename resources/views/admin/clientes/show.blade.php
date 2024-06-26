<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden rounded-lg bg-white p-3">
            <fieldset disabled class="mb-3 flex flex-col rounded-lg p-4 text-sm outline outline-1 outline-red-500">
                <h3 class="rounded-lg bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Pessoais</h3>
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
                                class="mt-1 flex-auto rounded border border-gray-300 px-2 py-2 text-sm">{{ !$cliente->data_nascimento ? date('d/m/y') : $cliente->data_nascimento->format('Y-m-d') }}</span>
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
                                class="mt-1 flex-1 rounded border border-gray-300 px-2 py-2 text-sm">{{ !$cliente->data_exp ? date('d/m/y') : $cliente->data_exp->format('Y-m-d') }}</span>
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
        </div>
        <div class="mt-3 flex flex-row">
            {{-- Dados residenciais --}}
            <div class="col-lg-4 relative overflow-hidden rounded-lg border bg-white py-2">
                <h1 class="rounded-lg bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 px-3 py-2 text-center text-sm font-semibold text-slate-50">
                    Dados Residenciais
                </h1>
                @empty($cliente->infoResidencial)
                @else
                    <a href="{{ route('admin.dados-residenciais.edit', $cliente->infoResidencial) }}"
                        class="absolute right-5 top-3.5 flex h-6 w-6 items-center justify-center rounded-lg bg-slate-100">
                        <i class="bi bi-pencil-fill font-sm font-semibold hover:text-red-500"></i>
                    </a>
                @endempty
                <div class="w-100 flex flex-col gap-2 rounded-lg bg-white p-4 text-sm">
                    @empty($cliente->infoResidencial)
                        Não possui dados residenciais
                    @else
                        <div class="flex flex-col">
                            <label class="font-semibold">CEP</label>
                            <span class="rounded-lg border border-gray-300 px-3 py-2">{{ $cliente->infoResidencial->cep }}</span>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold">Endereço</label>
                            <span class="rounded-lg border border-gray-300 px-3 py-2">{{ $cliente->infoResidencial->logradouro }}</span>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold">Complemento</label>
                            <span class="rounded-lg border border-gray-300 px-3 py-2">{{ $cliente->infoResidencial->complemento }}</span>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold">Bairro</label>
                            <span class="rounded-lg border border-gray-300 px-3 py-2">{{ $cliente->infoResidencial->bairro }}</span>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold">Cidade - UF</label>
                            <span class="rounded-lg border border-gray-300 px-3 py-2">{{ $cliente->infoResidencial->localidade . ' - ' . $cliente->infoResidencial->uf }}</span>
                        </div>
                    @endempty
                </div>
            </div>
            {{-- Dados Bancários --}}
            <div class="col-lg-4 overflow-hidden rounded-lg border bg-white py-2">
                <h1 class="rounded-lg bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 px-3 py-2 text-center text-sm font-semibold text-slate-50">Dados Bancários</h1>
                <div class="relative flex w-full flex-col items-center justify-center">
                    @forelse($cliente->infoBancarias as $infob)
                        <div id="{{ $infob->id }}"
                            class="min-h-100 flex w-full flex-col overflow-hidden rounded-lg bg-white px-3 py-4 text-sm hover:overflow-x-scroll lg:grid-cols-2">
                            <div class="col-span-2 flex flex-col">
                                <label class="font-medium">Banco</label>
                                <a href="{{ route('admin.dados-bancarios.edit', $infob) }}"
                                    class="absolute right-2 top-2 flex h-6 w-6 items-center justify-center rounded-full bg-slate-100">
                                    <i class="bi bi-pencil-fill text-sm font-semibold hover:text-red-500"></i>
                                </a>
                                <span class="text-nowrap rounded-md border border-gray-300 p-2 text-xs">{{ $infob->codigo . ' - ' . $infob->banco }}</span>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-medium">Ag.</label>
                                <span class="text-nowrap rounded-md border border-gray-300 p-2 text-xs">{{ $infob->agencia }}</span>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-medium">Conta</label>
                                <span class="text-nowrap rounded-md border border-gray-300 p-2 text-xs">{{ $infob->conta }}</span>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-medium">Tipo</label>
                                <span class="text-nowrap rounded-md border border-gray-300 p-2 text-xs">{{ $infob->tipo }}</span>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-medium">Op.</label>
                                <span class="text-nowrap rounded-md border border-gray-300 p-2 text-xs">{{ $infob->operacao }}</span>
                            </div>
                        </div>
                    @empty
                        Não possui dados bancários
                    @endforelse
                </div>
            </div>
            {{-- Dados funcionais --}}
            <div class="col-lg-4 overflow-hidden rounded-lg bg-white py-2">
                <h1 class="rounded-lg bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 px-3 py-2 text-center text-sm font-semibold text-slate-50">Dados Funcionais</h1>
                <div class="mt-2 w-auto overflow-x-auto">
                    <table class="text-nowrap w-full">
                        <thead class="bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 text-slate-50">
                            <tr>
                                <th>#</th>
                                <th>Órgão</th>
                                <th>Matrícula</th>
                                <th>Principal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cliente->vinculos as $vinculo)
                                <tr id="{{ $vinculo->id }}" class="odd:bg-slate-100 even:bg-slate-50">
                                    <td class="p-2 pl-2 pr-2">
                                        <a href="{{ route('admin.dados-funcionais.update', $vinculo->id) }}"
                                            class="flex h-6 w-6 items-center justify-center rounded-full bg-slate-100">
                                            <i class="bi bi-pencil-fill text-sm font-semibold hover:text-red-500"></i>
                                        </a>
                                    </td>
                                    <td class="text-wrap p-2 pl-2 pr-2">{{ $vinculo->organizacao->nome_organizacao }}</td>
                                    <td class="text-wrap p-2 pl-2 pr-2">{{ $vinculo->nrbeneficio }}</td>
                                    <td class="text-wrap p-2 pl-2 pr-2">{{ $vinculo->phone1 }}</td>
                                </tr>
                            @empty
                                Não possui dados bancários
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Propostas do cliente --}}
        <div class="mt-3 overflow-hidden overflow-x-auto rounded-lg bg-white px-8 py-5 shadow-md">
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
                            <td class="text-nowrap text-ellipsis p-1 pl-2 pr-2 text-xs font-medium">{{ $proposta->produto->descricao_produto }}</td>
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
</x-midas-layout>
