<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-5">
            <div class="mb-5 w-full bg-white px-4 py-3 text-[0.9rem] shadow-sm dark:bg-slate-600 sm:rounded-lg">
                <div class="w-100 flex flex-col items-start overflow-x-scroll px-5 py-4">
                    <table class="table-auto" id="listas" style="width: 100%;">
                        <caption class="caption-top">Campanha Governo</caption>
                        <thead class="text-light bg-gradient-to-b from-gray-900 via-slate-600 to-slate-900 font-bold">
                            <td class="py-2">
                            </td>
                            <td class="py-2">
                                Nome
                            </td>
                            <td class="py-2">
                                CPF
                            </td>
                            <td class="py-2">
                                Órgão
                            </td>
                        </thead>
                        <tbody class="text-sm">
                            @foreach ($listas as $lista)
                                <tr class="odd:bg-gray-200 even:bg-slate-50 hover:bg-emerald-500 hover:bg-opacity-20">
                                    <td class="text-truncate px-3 py-2">
                                        <a id="call_{{ $lista->id }}" href="javascript:void(0)" onclick="modalLista('{{ $lista->id }}')"
                                            data-url="{{ route('api.cliente', $lista->id) }}" data-update="{{ route('admin.calls.update', $lista->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#modalLigacao"
                                            class="lista-show rounded-full bg-gradient-to-b from-blue-900 to-blue-700 px-3 py-1 text-[12px] font-semibold text-[#ffffff] transition delay-200 ease-in-out hover:scale-110 hover:bg-gradient-to-b hover:from-emerald-950 hover:to-emerald-600 hover:text-[14px] hover:text-gray-50">
                                            Ligar
                                        </a>
                                    </td>
                                    <td class="text-truncate px-2 py-2 capitalize">
                                        {{ strtolower($lista->nome) }}
                                    </td>
                                    <td class="text-truncate px-2 py-2 capitalize">
                                        {{ $lista->cpf }}
                                    </td>
                                    <td class="text-truncate px-2 py-2 capitalize">
                                        {{ strtolower($lista->orgao) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
<div class="modal fade text-stone-700" id="modalLigacao" tabindex="-1" aria-labelledby="modaLigacaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5 text-slate-700" aria-label="modalLigacaoLabel">Call Center </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.calls.update', 1) }}" id="gov-update" class="mt-3" method="post">
                    @csrf @method('PATCH')
                    <div class="row">
                        <div class="col-lg-3 form-group mb-3">
                            <label class="text-xs font-semibold" for="mdata_ligacao">Cantato</label>
                            <input type="date" name="data_ligacao" id="mdata_ligacao" value="{{ old('data_ligacao') ?? date('Y-m-d') }}"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                        <div class="col-lg-3 form-group mb-3">
                            <label class="text-xs font-semibold" for="data_agendamento">Agendamento</label>
                            <input type="date" name="data_agendamento" id="mdata_agendamento" value="{{ old('data_agendamento') ?? date('Y-m-d') }}"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                        <div class="col-lg-3 form-group mb-3">
                            <label class="text-xs font-semibold" for="mstatus_id">Status</label>
                            <select name="status_id" id="mstatus_id" required
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                            <span class="text-slate-500 text-sm" id="status-helper-text"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 form-group mb-3">
                            <label class="text-xs font-semibold" for="nome">Nome</label>
                            <input type="text" name="nome" id="mnome" value="{{ old('nome') }}"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                        <div class="col-lg-4 form-group mb-3">
                            <label class="text-xs font-semibold" for="mcpf">CPF</label>
                            <input type="text" name="cpf" id="mcpf" value="{{ old('cpf') }}"
                                class="cpf w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 form-group mb-3">
                            <label class="text-xs font-semibold" for="mmatricula">Matrícula</label>
                            <input type="text" name="matricula" id="mmatricula" value="{{ old('matricula') }}"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            <label class="text-xs font-semibold" for="morgao">Órgão</label>
                            <select name="organizacao_id" id="morgao"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                @foreach($orgaos as $orgao)
                                    <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                @endforeach
                            </select>
                            <span class="text-slate-500 text-xs" id="orgao-helper-text"></span>
                        </div>

                        <div class="form-group col-lg-3 mb-3">
                            <label class="text-xs font-semibold" for="mmargem">Margem</label>
                            <input type="number" name="margem" id="mmargem" min="0" max="1000000" step="0.01" value="{{ old('margem') }}"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-right text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3 mb-3">
                            <label class="text-xs font-semibold" for="mtelefone">Telefone</label>
                            <input type="text" name="telefone" id="mtelefone"
                                class="telefone w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            <label class="text-xs font-semibold" for="mproduto">Produto</label>
                            <select type="text" name="produto_id" id="mproduto"
                                class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                                @foreach($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->descricao_produto }}</option>
                                @endforeach
                            </select>
                            <span class="text-slate-500 text-sm" id="produto-helper-text"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 form-group mb-3">
                            <label class="text-xs font-semibold" for="mobservacoes">Observações</label>
                            <textarea name="observacoes" id="mobservacoes" rows="5" class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 w-full">
                        <button type="submit"
                            class="rounded-full bg-green-600 px-3 py-1 text-sm text-stone-100 transition delay-150 ease-in-out hover:scale-105 hover:bg-green-700 hover:text-stone-100 hover:shadow-md hover:shadow-black">
                            Enviar
                        </button>
                    </div>
                    <input type="hidden" name="muser_id">
                </form>
            </div>
        </div>
    </div>
</div>
