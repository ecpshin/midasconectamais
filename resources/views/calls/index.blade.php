<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-5">
            <div class="mb-5 w-full bg-white px-4 py-3 text-[0.9rem] shadow-sm dark:bg-slate-600 sm:rounded-lg">
                <div class="w-100 flex flex-col items-start overflow-x-scroll px-5 py-4">
                    <div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalLigacao" class="rounded-full bg-teal-500 px-5 py-1 text-white hover:bg-teal-700">
                            <i class="bi bi-headset nav-icon"></i>
                            Ligação
                        </button>
                    </div>
                    <table id="listas" class="table-auto" style="width: 100%;">
                        <caption class="caption-top">Call Center</caption>
                        <thead class="text-light bg-slate-700 font-bold">
                            <tr>
                                <th class="py-2">#</th>
                                <th class="py-2">Ligação</th>
                                <th class="py-2">Agendado</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Agente</th>
                                <th class="py-2">Nome</th>
                                <th class="py-2">CPF</th>
                                <th class="py-2">Matrícula</th>
                                <th class="py-2">Órgão</th>
                                <th class="py-2">Produto</th>
                                <th class="py-2">...</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse ($calls as $call)
                                <tr class="bg-gray-200 even:bg-slate-50 hover:bg-red-400 hover:bg-opacity-20">
                                    <td class="text-truncate px-3 py-2 capitalize">{{ $call->id }}</td>
                                    <td class="text-truncate px-2 py-2 capitalize">
                                        {{ $call->data_ligacao ? $call->data_ligacao->format('d/m/Y') : 'Não definida' }}
                                    </td>
                                    <td class="text-truncate px-2 py-2 capitalize">
                                        @if (!is_null($call->data_agendamento))
                                            {{ $call->data_agendamento->format('d/m/Y') }}
                                        @else
                                            Não definido
                                        @endif
                                    </td>
                                    <td class="text-truncate px-2 py-2 capitalize">{{ $call->status->status_description ?? 'Nulo' }}</td>
                                    <td class="text-truncate px-2 py-2 font-bold capitalize">{{ $call->user->name ?? 'Naõ definido' }}</td>
                                    <td class="text-truncate px-2 py-2 capitalize">{{ $call->nome }}</td>
                                    <td class="text-truncate px-2 py-2 capitalize">{{ $call->cpf }}</td>
                                    <td class="text-truncate px-2 py-2 capitalize">{{ $call->matricula }}</td>
                                    <td class="text-truncate px-2 py-2 capitalize">{{ $call->orgao }}</td>
                                    <td class="text-truncate px-2 py-2 capitalize">{{ $call->produto }}</td>
                                    <td class="flex px-2 py-2">
                                        <a href="{{ route('admin.calls.edit', $call) }}"
                                            class="rounded-full bg-yellow-500 px-3 py-1 text-sm text-black hover:text-white">Editar</a>
                                        <a href="{{ route('admin.calls.propostas', $call) }}"
                                            class="rounded-full bg-sky-500 px-3 py-1 text-sm text-black hover:text-white">Proposta</a>

                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade text-stone-700" id="modalLigacao" tabindex="-1" aria-labelledby="modaLigacaoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-to-b from-slate-900 via-slate-600 to-slate-800">
                        <h3 class="modal-title w-100 text-center text-slate-50" aria-label="modalLigacaoLabel">Call Center</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.calls.store') }}" class="mt-3 flex flex-col" method="post">
                            @csrf
                            <div class="row flex flex-row justify-between">
                                <div class="col-lg-3">
                                    <div class="form-group flex flex-col">
                                        <label class="text-xs font-semibold" for="data_ligacao">Ligação</label>
                                        <input type="date" name="data_ligacao" id="data_ligacao" required value="{{ date('Y-m-d') }}"
                                            class="form-input rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-3 flex flex-col">
                                        <label class="text-xs font-semibold" for="agendado">Agendamento</label>
                                        <input type="date" name="data_agendamento" id="data_agendamento" value="{{ date('Y-m-d') }}"
                                            class="form-input rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group flex flex-col">
                                        <label class="text-xs font-semibold" for="status_id">Status</label>
                                        <select name="status_id" id="status_id" required class="select2 rounded-lg text-black border-gray-300 text-xs">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex flex-row items-baseline justify-between">
                                <div class="col-lg-8">
                                    <div class="form-group flex flex-col">
                                        <label class="text-xs font-semibold" for="nome">Nome</label>
                                        <input type="text" name="nome" id="nome" required
                                            class="rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group flex flex-col">
                                        <label class="text-xs font-semibold" for="cpf">CPF</label>
                                        <input type="text" name="cpf" id="cpf"
                                            class="cpf rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                    </div>
                                </div>
                            </div>
                            <div class="row flex flex-row items-baseline justify-between">
                                <div class="col-lg-3">
                                    <div class="form-group flex flex-col">
                                        <label class="text-xs font-semibold" for="matricula">Matrícula</label>
                                        <input type="text" name="matricula" id="matricula"
                                            class="rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group flex flex-col">
                                        <label class="text-xs font-semibold" for="orgao">Órgão</label>
                                        <select name="organizacao_id" id="orgao_id" class="form-select rounded-lg border-gray-300 text-black text-xs">
                                            @forelse ($orgaos as $orgao)
                                                <option value="{{ $orgao->id }}" class="text-black">{{ $orgao->nome_organizacao }}</option>
                                            @empty
                                                Não há órgãos cadastrados
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group flex flex-col">
                                        <label class="text-xs font-semibold" for="margem">Margem</label>
                                        <input type="number" name="margem" id="margem" min="0" max="1000000" step="0.01"
                                            class="rounded-lg border-gray-300 text-right text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-3 mb-3">
                                    <label class="text-xs font-semibold" for="telefone">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" value="(84)9 0000-0000"
                                        class="telefone w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                                </div>
                                <div class="form-group col-lg-4 mb-3">

                                    <label class="text-xs font-semibold" for="produto">Produto</label>
                                    <select name="produto_id" id="product_id" class="form-select rounded-lg border-gray-300 text-xs">
                                        @forelse ($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->descricao_produto }}</option>
                                        @empty
                                            Não há órgãos cadastrados
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 form-group mb-3">
                                    <label class="text-xs font-semibold" for="observacoes">Observações</label>
                                    <textarea name="observacoes" id="observacoes" rows="5" class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0"></textarea>
                                </div>
                            </div>
                            <div class="mt-3 w-full">
                                <button type="submit"
                                    class="rounded-full bg-teal-700 px-3 py-1 text-sm text-stone-100 transition delay-150 ease-in-out hover:scale-105 hover:bg-teal-800 hover:text-stone-100 hover:shadow-md hover:shadow-black">
                                    Salvar Dados
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
