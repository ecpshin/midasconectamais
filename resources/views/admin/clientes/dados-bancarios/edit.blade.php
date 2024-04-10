<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.dados-bancarios.update', $dados) }}" method="post">
                @csrf @method('PATCH')
                <fieldset title="infoBancárias" class="mb-4 flex flex-col gap-0 rounded-lg p-5 outline outline-1 outline-red-500">
                    <h3 class="rounded-lg bg-rose-900 py-2 text-center text-xl text-slate-50">Dados Bancários</h3>
                    <div class="grid grid-cols-1">
                        <div class="my-3 flex flex-col lg:col-span-1">
                            <label for="codigo">Cliente</label>
                            <span
                                class="mt-1 flex-1 rounded border border-gray-300 px-3 py-1 py-2 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0">{{ $dados->cliente->nome }}</span>
                        </div>
                    </div>
                    <div class="grid gap-3 lg:grid-cols-12">
                        <div class="my-3 flex flex-col lg:col-span-1">
                            <label for="codigo">Código</label>
                            <input type="text" name="codigo" id="codigo" value="{{ $dados->codigo }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="001">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-3">
                            <label for="banco">Nome Banco</label>
                            <input type="text" name="banco" id="banco" value="{{ $dados->banco }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Banco da Caixola S.A.">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="agencia">Agência</label>
                            <input type="text" name="agencia" id="agencia" value="{{ $dados->agencia }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="0000-x">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="conta">Conta</label>
                            <input type="text" name="conta" id="conta" value="{{ $dados->conta }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Ex.: 12313-5">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="tipo">Tipo</label>
                            <input type="text" name="tipo" id="tipo" value="{{ $dados->tipo }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Conta Corrente">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="operacao">Operação</label>
                            <input type="text" name="operacao" id="operacao" value="{{ $dados->operacao }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="011">
                        </div>
                    </div>
                </fieldset>
                <div class="mx-3 my-3">
                    <button type="submit" class="rounded-lg bg-green-900 px-3 py-2 text-gray-100">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-midas-layout>
