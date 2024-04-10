<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.dados-residenciais.update', $dados) }}" method="post">
                @csrf @method('PATCH')
                <fieldset title="Informações Residenciais" class="mb-4 flex flex-col gap-0 rounded-lg p-4 outline outline-1 outline-red-500">
                    <h3 class="rounded-lg bg-rose-900 py-2 text-center text-xl text-slate-50">Dados Residenciais</h3>
                    <div class="grid grid-cols-1">
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label>Cliente</label>
                            <span class="w-100 mt-1 flex-1 rounded border border-gray-300 px-3 py-1">{{ $dados->cliente->nome }}</span>
                        </div>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-1 lg:grid-cols-12">
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="cep">CEP</label>
                            <input type="text" name="cep" id="cep" value="{{ $dados->cep }}"
                                class="w-100 mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="59000000">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-6">
                            <label for="logradouro">Endereço, nº</label>
                            <input type="text" name="logradouro" id="logradouro" value="{{ $dados->logradouro }}"
                                class="w-100 mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Rua Tabajara, 10">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-4">
                            <label for="complemento">Complemento</label>
                            <input type="text" name="complemento" id="complemento" value="{{ $dados->complemento }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Ex.: Condomínio das Acácias Bloco 2 Apto. 503 5º Andar">
                        </div>
                    </div>
                    <div class="grid gap-3 lg:grid-cols-12">
                        <div class="my-3 flex flex-col lg:col-span-5">
                            <label for="bairro">Bairro</label>
                            <input type="text" name="bairro" id="bairro" value="{{ $dados->bairro }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Bairro">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-6">
                            <label for="localidade">Cidade</label>
                            <input type="text" name="localidade" id="localidade" value="{{ $dados->localidade }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Cidade">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-1">
                            <label for="uf">UF</label>
                            <input type="text" name="uf" id="uf" value="{{ $dados->uf }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="RN">
                        </div>
                    </div>
                </fieldset>
                <div class="px-3 py-2">
                    <button type="submit" class="rounded bg-green-700 px-3 py-2 text-slate-50">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-midas-layout>
