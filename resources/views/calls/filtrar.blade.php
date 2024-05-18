<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-5">
            <div class="mb-5 w-full bg-white px-4 py-3 text-[0.9rem] shadow-sm dark:bg-slate-600 sm:rounded-lg">
                <div class="w-100 flex flex-col items-start overflow-x-scroll px-5 py-4">
                    <form action="{{ route('admin.calls.filtrar') }}" method="POST" class="w-100 flex flex-row items-end justify-between bg-slate-100">
                        @csrf
                        <div class="col-lg-3 col-sm-12">
                            <label>Inícial</label>
                            <input type="date" name="inicio" id="inicio" value="" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm- 12 col-lg-3">
                            <label class="form-label">Final</label>
                            <input type="date" name="final" id="fim" value="" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <label>Agente</label>
                            <select name="user_id" id="user_id" class="form-control form-control-sm">
                                <option value="3">Selecione</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <button type="submit" class="rounded-full bg-teal-500 px-5 py-1 text-white hover:bg-teal-700">
                                <i class="bi bi-funnel nav-icon"></i>
                                Filtrar
                            </button>
                        </div>
                    </form>
                    @if (isset($calls))
                        <div class="table-container">
                            <table id="listas" class="table-auto" style="width: 100%;">
                                <caption class="caption-top">Call Center</caption>
                                <thead class="text-light bg-slate-700 font-bold">
                                    <tr>
                                        <td class="py-2">#</td>
                                        <td class="py-2">Data Ligação</td>
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
                                    @forelse ($calls as $call)
                                        <tr class="bg-gray-200 even:bg-slate-50 hover:bg-red-400 hover:bg-opacity-20">
                                            <td class="text-truncate px-3 py-2 capitalize">{{ $call->id }}</td>
                                            <td class="text-truncate px-2 py-2 capitalize">
                                                {{ !is_null($call->data_ligacao) ? $call->data_ligacao->format('d/m/Y') : 'Não definido' }}</td>
                                            <td class="text-truncate px-2 py-2 capitalize">{{ $call->user->name ?? 'Não definido' }}</td>
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
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
