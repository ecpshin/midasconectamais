<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-5">
            <div class="mb-5 w-full bg-white px-4 py-3 text-[0.9rem] shadow-sm dark:bg-slate-600 sm:rounded-lg">
                <div class="w-100 flex flex-col items-start overflow-x-scroll px-5 py-4">
                    <div class="flex w-full flex-row items-center justify-between">
                        <form action="{{ route('admin.calls.lista-agendados') }}" method="post" class="flex flex-row items-center gap-2">
                            @csrf
                            <label>Data de Agendamento</label>
                            <input type="date" name="data_agendamento" class="form-control form-control-sm rounded-full px-3 py-2" id="data_agendamento">
                            <button type="submit" class="tex-sm rounded-full bg-sky-400 px-3 py-2 text-white hover:bg-sky-600">Buscar</button>
                        </form>
                    </div>
                    @if (count($calls) > 0 && !is_null($calls))
                        <table id="listas" class="table-auto" style="width: 100%;">
                            <caption class="caption-top">Call Center</caption>
                            <thead class="text-light bg-gradient-to-br from-slate-700 to-slate-600 font-bold">
                                <tr>
                                    <td class="py-2">#</td>
                                    <td class="py-2">Data Ligação</td>
                                    <td class="py-2">Data Agendamento</td>
                                    <td class="py-2">Agente</td>
                                    <td class="py-2">Nome</td>
                                    <td class="py-2">CPF</td>
                                    <td class="py-2">Matrícula</td>
                                    <td class="py-2">Órgão</td>
                                    <td class="py-2">Produto</td>
                                    <td class="py-2">...</td>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($calls as $call)
                                    <tr class="bg-gray-200 even:bg-slate-50 hover:bg-red-400 hover:bg-opacity-20">
                                        <td class="text-truncate px-3 py-2 capitalize">{{ $call->id }}</td>
                                        <td class="text-truncate px-2 py-2 capitalize">
                                            {{ !is_null($call->data_ligacao) ? $call->data_ligacao->format('d/m/Y') : 'Naõ definido' }}
                                        </td>
                                        <td class="text-truncate px-2 py-2 capitalize">
                                            {{ $call->data_agendamento->format('d/m/Y') ?? 'Naõ definido' }}
                                        </td>
                                        <td class="text-truncate px-2 py-2 capitalize">{{ $call->user->name ?? 'Naõ definido' }}</td>
                                        <td class="text-truncate px-2 py-2 capitalize">{{ $call->nome }}</td>
                                        <td class="text-truncate px-2 py-2 capitalize">{{ $call->cpf }}</td>
                                        <td class="text-truncate px-2 py-2 capitalize">{{ $call->matricula }}</td>
                                        <td class="text-truncate px-2 py-2 capitalize">{{ $call->orgao }}</td>
                                        <td class="text-truncate px-2 py-2 capitalize">{{ $call->produto }}</td>
                                        <td class="flex px-2 py-2">
                                            <a href="{{ route('admin.calls.edit', $call) }}"
                                                class="rounded-full bg-yellow-500 px-3 py-1 text-sm text-black hover:text-white">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

    </div>
</x-midas-layout>
