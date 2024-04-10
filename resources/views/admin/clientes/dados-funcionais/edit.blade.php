<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.dados-funcionais.update', $dados) }}" method="post">
                @csrf @method('PATCH')
                <fieldset title="Info Funcionais" class="mb-4 flex flex-col gap-0 rounded-lg p-4 outline outline-1 outline-red-500">
                    <h3 class="rounded-lg bg-rose-900 py-2 text-center text-xl text-slate-50">Dados Funcionais</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="my-3 flex flex-col">
                            <label for="organizacao_id">Órgão</label>
                            <select name="organizacao_id" id="organizacao_id" class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($orgaos as $orgao)
                                    <option value="{{ $orgao->id }}" @if ($orgao->id == $dados->id) selected @endif>{{ $orgao->nome_organizacao }}</option>
                                @empty
                                    <option value="1">Não há órgãos cadastrados</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="nrbeneficio">Nº Benefício | Matrícula</label>
                            <input type="text" name="nrbeneficio" id="nrbeneficio" value="{{ $dados->nrbeneficio }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Número do benefício ou matrícula">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4">
                        <div class="my-3 flex flex-col">
                            <label for="phone1">Tel. Principal</label>
                            <input type="text" name="phone1" id="phone1" value="{{ $dados->phone1 }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="phone2">Tel. Família</label>
                            <input type="text" name="phone2" id="phone2" value="{{ $dados->phone2 }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="phone3">Tel. Recado 1</label>
                            <input type="text" name="phone3" id="phone3" value="{{ $dados->phone3 }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="phone">Tel. Recado 2</label>
                            <input type="text" name="phone4" id="phone4" value="{{ $dados->phone4 }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="flex flex-col">
                            <label for="Senha e e-mails">Senha e emails</label>
                            <textarea id="emails_senhas" name="emails_senhas" class="mt-2 rounded-lg border-gray-400 placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-0"
                                placeholder="Espaço reservado para Senhas e Emails">{{ $dados->emails_senhas }}</textarea>
                        </div>
                    </div>
                </fieldset>
                <div class="mx-3 my-3">
                    <button type="submit" class="rounded-lg bg-green-700 px-3 py-2 text-slate-100">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-midas-layout>
