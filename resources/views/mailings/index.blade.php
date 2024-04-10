<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-5">
            <div class="mb-5 w-full bg-white text-[0.9rem] shadow-sm dark:bg-slate-600 sm:rounded-lg">
                <div class="w-100 flex flex-col items-center py-4">
                    @empty($mailings)
                        <a href="{{ route('admin.mailings.create') }}" class="rounded-md bg-blue-500 px-5 py-1 text-white">Carregar Mailings</a>
                    @endempty
                    <table class="table-auto" id="listas" style="width: 100%;">
                        <caption class="caption-top">Mailing para campanha de telemarketing</caption>
                        <thead class="text-light bg-red-700 font-bold">
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
                            <td class="py-2">                                
                            </td>
                        </thead>
                        <tbody class="text-sm">
                            @foreach ($mailings as $mailing)
                                <tr class="bg-gray-200 even:bg-slate-50 hover:bg-red-400 hover:bg-opacity-20">
                                    <td class="text-truncate px-3 py-2">
                                        <a id="show_{{ $mailing->id }}" href="javascript:void(0)" onclick="modalMailing('{{ $mailing->id }}')"
                                            data-url="{{ route('admin.mailings.show', $mailing->id) }}" data-bs-toggle="modal" data-bs-target="#modalAtendimento"
                                            class="mailing-show rounded-full bg-blue-700 px-2 py-1 text-[10px] font-semibold text-[#ffffff] transition delay-200 ease-in-out hover:scale-110 hover:bg-lime-300 hover:text-[11px] hover:text-gray-600">
                                            Atender
                                        </a>
                                    </td>
                                    <td class="text-truncate px-2 py-2 capitalize">
                                        {{ strtolower($mailing->nome) }}
                                    </td>
                                    <td class="text-truncate px-2 py-2 capitalize">
                                        {{ $mailing->cpf }}
                                    </td>
                                    <td class="text-truncate px-2 py-2 capitalize">
                                        {{ strtolower($mailing->orgao) }}
                                    </td>
                                    <td disabled>
                                        <a href="#" class="bg-red-700 text-white py-2 px-1" onclick="document.getElementById('form_{{$mailing->id}}').submit()">Excluir</a>
                                        <form action="{{ route('admin.mailings.destroy', $mailing->id) }}" method="POST" id="form_{{$mailing->id}}">@csrf @method('DELETE')</form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modalAtendimento" tabindex="-1" aria-labelledby="modalAtendimentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" aria-label="modalAtendimentoLabel">Modal Atendimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mailings.agents.store') }}" method="post">@csrf
                        <div class="row justify-end">
                            <div class="col-lg-3 form-group mb-3">
                                <label class="text-xs font-semibold" for="data_consulta">Data Consulta</label>
                                <input type="date" name="data_consulta" id="modal-date" value="{{ date('Y-m-d') }}"
                                    class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 form-group mb-3">
                                <label class="text-xs font-semibold" for="nome">Nome</label>
                                <input type="text" name="nome" id="modal-nome"
                                    class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <label class="text-xs font-semibold" for="cpf">CPF</label>
                                <input type="text" name="cpf" id="modal-cpf"
                                    class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 form-group mb-3">
                                <label class="text-xs font-semibold" for="matricula">Matrícula</label>
                                <input type="text" name="matricula" id="modal-matricula"
                                    class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                            <div class="form-group col-lg-4 mb-3">
                                <label class="text-xs font-semibold" for="orgao">Órgão</label>
                                <input type="text" name="orgao" id="modal-orgao"
                                    class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                            </div>
                            <div class="form-group col-lg-4 mb-3">
                                <label class="text-xs font-semibold" for="margem">Margem</label>
                                <input type="text" name="margem" id="modal-margem"
                                    class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 form-group mb-3">
                                <label class="text-xs font-semibold" for="matricula">Observações</label>
                                <textarea name="observacoes" id="modal-observacoes" rows="5" class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0"></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="modal-id" name="id" value="">
                        <div class="mt-3 w-full">
                            <button type="submit"
                                class="rounded-full bg-green-600 px-3 py-1 text-sm text-stone-100 transition delay-150 ease-in-out hover:scale-105 hover:bg-green-700 hover:text-stone-100 hover:shadow-md hover:shadow-black">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
