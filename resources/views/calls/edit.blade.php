<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white mb-5 shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.calls.update', $call) }}" class="mt-3" method="post">
                        @csrf @method('PATCH')
                        <div class="row">
                            <div class="col-lg-3 form-group mb-3">
                                <label class="text-xs font-semibold" for="data_ligacao">Ligação</label>
                                <input type="date" name="data_ligacao" id="data_ligacao" value="{{$call->data_ligacao}}"
                                    class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                            <div class="col-lg-3 form-group mb-3">
                                <label class="text-xs font-semibold" for="agendado">Agendamento</label>
                                <input type="date" name="agendado" id="data_agendado" value="{{ $call->data_agendamento }}"
                                    class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                            <div class="col-lg-3 form-group mb-3">
                                <label class="text-xs font-semibold" for="status_id">Status</label>
                                <select name="status_id" id="status_id" class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                                    <option value="">Selecione</option>
                                    @foreach ($statuses as $status)
                                    <option value="{{$status->id}}" @if($call->status->id == $status->id) selected @endif>
                                        {{$status->status}}
                                    </option>                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 form-group mb-3">
                                <label class="text-xs font-semibold" for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" value="{{ $call->nome }}"
                                       class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <label class="text-xs font-semibold" for="cpf">CPF</label>
                                <input type="text" name="cpf" id="cpf" value="{{ $call->cpf }}"
                                       class="cpf w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 form-group mb-3">
                                <label class="text-xs font-semibold" for="matricula">Matrícula</label>
                                <input type="text" name="matricula" id="matricula" value="{{ $call->matricula }}"
                                       class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">
                            </div>
                            <div class="form-group col-lg-6 mb-3">
                                <label class="text-xs font-semibold" for="orgao">Órgão</label>
                                <input type="text" name="orgao" id="orgao" value="{{ $call->orgao }}"
                                       class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                            </div>

                            <div class="form-group col-lg-3 mb-3">
                                <label class="text-xs font-semibold" for="margem">Margem</label>
                                <input type="number" name="margem" id="margem" value="{{ $call->margem }}" min="0" max="1000000" step="0.01"
                                       class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3 mb-3">
                                <label class="text-xs font-semibold" for="telefone">Telefone</label>
                                <input type="text" name="telefone" id="telefone" value="{{ $call->telefone }}"
                                       class="telefone w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                            </div>
                            <div class="form-group col-lg-4 mb-3">
                                <label class="text-xs font-semibold" for="produto">Produto</label>
                                <input type="text" name="produto" id="produto" value="{{ $call->produto }}"
                                       class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:outline-green-100 active:ring-0">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 form-group mb-3">
                                <label class="text-xs font-semibold" for="observacoes">Observações</label>
                                <textarea name="observacoes" id="observacoes" rows="5"
                                          class="w-100 mt-1 flex-1 rounded-lg border-gray-300 text-xs outline-none active:border-none active:ring-0">{{$call->observacoes}}</textarea>
                            </div>
                        </div>
                        <div class="mt-3 w-full">
                            <button type="submit"
                                    class="rounded-full bg-green-600 px-3 py-1 text-sm text-stone-100 transition delay-150 ease-in-out hover:scale-105 hover:bg-green-700 hover:text-stone-100 hover:shadow-md hover:shadow-black">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </form>
</x-midas-layout>
