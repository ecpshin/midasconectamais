<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <div class="mx-6">
                        <a href="{{ route('admin.tabelas.create') }}"
                            class="rounded-full bg-emerald-900 px-3 py-2 text-xs text-white shadow-md shadow-emerald-950 hover:bg-emerald-600">Adicionar</a>
                        <a href="{{ route('admin.tabelas.export', 'xlsx') }}"
                            class="rounded-full bg-slate-900 px-3 py-2 text-xs text-slate-50 shadow-md shadow-slate-950 hover:bg-slate-600" role="button">Exportar</a>
                    </div>
                    <div class="overflow-x-auto rounded-lg bg-white px-8 py-6">
                        <table class="my-8 w-full whitespace-nowrap text-xs" id="tabela">
                            <thead class="bg-gradient-to-b from-slate-950 via-slate-600 to-slate-800 font-bold text-slate-100">
                                <tr>
                                    <td class="py-2">ID</td>
                                    <td class="pl-2">Tabela</td>
                                    <td class="pl-2">Código</td>
                                    <td class="pl-2">Produto</td>
                                    <td class="pl-2">Financeira</td>
                                    <td class="pl-2">Correspondente</td>
                                    <td class="pl-2">% Loja</td>
                                    <td class="pl-2">% Agente</td>
                                    <td class="pl-2">% Corretor</td>
                                    <td class="pl-2">Prazo</td>
                                    <td class="pl-2">Gera Parcela</td>
                                    <td class="pl-2">Referência de Cálculo</td>
                                    <td class="pl-2">Ações</td>
                                </tr>
                            </thead>
                            <tbody class="text-xs font-semibold">
                                @forelse ($tabelas ?? [] as $tabela)
                                    <tr class="bg-gray-200 transition duration-200 even:bg-slate-50 hover:bg-red-400 hover:bg-opacity-20">
                                        <td class="pl-2">{{ $tabela->id }}</td>
                                        <td class="pl-2 capitalize">{{ $tabela->descricao }}</td>
                                        <td class="pl-2 capitalize">{{ $tabela->codigo }}</td>
                                        <td class="pl-2 capitalize">{{ $tabela->produto->descricao_produto }}</td>
                                        <td class="pl-2 capitalize">{{ $tabela->financeira->nome_financeira }}</td>
                                        <td class="pl-2 capitalize">{{ $tabela->correspondente->nome_correspondente }}</td>
                                        <td class="pl-2 capitalize">{{ $fmt->percentage($tabela->percentual_loja, 3, 2, 'pt-BR') }}</td>
                                        <td class="pl-2 capitalize">{{ $fmt->percentage($tabela->percentual_agente, 3, 2, 'pt-BR') }}</td>
                                        <td class="pl-2 capitalize">{{ $fmt->percentage($tabela->percentual_corretor, 3, 2, 'pt-BR') }}</td>
                                        <td class="pl-2 capitalize">{{ $tabela->prazo }}</td>
                                        <td class="pl-2 capitalize">{{ $tabela->parcelado == 1 ? 'Sim' : 'Não' }}</td>
                                        <td class="pl-2 capitalize">{{ !is_null($tabela->referencia) ? $tabela->referencia : 'L' }}</td>
                                        <td class="flex items-center space-x-1 py-1 pl-2">
                                            <a href="{{ route('admin.tabelas.show', $tabela) }}"
                                                class="rounded-md bg-sky-800 px-2 py-2 shadow-md shadow-slate-500 hover:bg-sky-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50 hover:text-slate-50" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.tabelas.edit', $tabela) }}"
                                                class="rounded-md bg-yellow-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-yellow-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <a href="#" class="rounded-md bg-red-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-red-900"
                                                onclick="confirmar('{{ $tabela->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.tabelas.destroy', $tabela->id) }}" method="post" id="form_{{ $tabela->id }}">
                                                @csrf @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            Não há tabelas registradas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
