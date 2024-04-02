<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="post" class="flex flex-col">
                @csrf @method('PATCH')
                {{-- InfoPessoais --}}
                <fieldset x-show="true" title="Dados pessoais" class="mb-3 flex flex-col gap-0 rounded-lg p-4 outline outline-1 outline-red-500">
                    <h3 class="rounded-lg bg-rose-900 py-2 text-center text-xl text-slate-50">Dados Pessoais</h3>
                    <div class="grid gap-3 lg:grid-cols-12">
                        <div class="my-3 flex flex-col sm:col-span-12 lg:col-span-8">
                            <label for="nome">Nome Completo</label>
                            <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 text-xs placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome completo">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" maxlength="14" size="14" required value="{{ $cliente->cpf }}"
                                class="mt-1 flex-auto rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="CPF">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="data_nascimento">Data Nasc.</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" value="{{ $cliente->data_nascimento }}"
                                class="mt-1 flex-auto rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                title="Data de nascimento">
                        </div>
                    </div>
                    <div class="grid gap-3 lg:grid-cols-12">
                        <div class="my-3 flex flex-col lg:col-span-5">
                            <label for="rg">RG</label>
                            <input type="text" name="rg" id="rg" value="{{ $cliente->rg }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="RG">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="orgao_exp">Órgão Exp</label>
                            <input type="text" name="orgao_exp" id="orgao_exp" value="{{ $cliente->orgao_exp ?? 'SSP/RN' }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Órgão expedidor">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-2">
                            <label for="data_exp">Data Exp.</label>
                            <input type="date" name="data_exp" id="data_exp" value="{{ $cliente->data_exp }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                title="Data da expedição">
                        </div>
                        <div class="my-3 flex flex-col lg:col-span-3">
                            <label for="naturalidade">Naturalidade</label>
                            <input type="text" name="naturalidade" id="naturalidade" value="{{ $cliente->naturalidade ?? 'Natal/RN' }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Naturalidade">
                        </div>
                    </div>
                    <div class="grid gap-5 lg:grid-cols-4">
                        <div class="my-3 flex flex-col">
                            <label for="genitora">Nome da Mãe</label>
                            <input type="text" name="genitora" id="genitora" value="{{ $cliente->genitora }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome da mãe">
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="genitor">Nome do Pai</label>
                            <input type="text" name="genitor" id="genitor" value="{{ $cliente->genitor }}"
                                class="mt-1 flex-1 rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome do pai">
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="sexo">Sexo</label>
                            <select name="sexo" id="sexo" class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="{{ $cliente->sexo }}">{{ $cliente->sexo }}</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Não Binário (LGBTQI+)">Não Binário (LGBTQI+)</option>
                            </select>
                        </div>
                        <div class="my-3 flex flex-col">
                            <label for="estado_civil">Estado Civil</label>
                            <select name="estado_civil" id="estado_civil" class="mt-2 rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="{{ $cliente->estado_civil }}">{{ $cliente->estado_civil }}</option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Desquitado(a)">Desquitado(a)</option>
                                <option value="Divorciado(a)">Divorciado(a)</option>
                                <option value="Separado(a)">Separado(a)</option>
                                <option value="Solteiro(a)">Solteiro(a)</option>
                                <option value="União Estável">União Estável</option>
                                <option value="União Estável Homoafetiva">União Estável Homoafetiva</option>
                                <option value="Não informado">Não informado</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <div>
                    <button type="submit" class="rounded-lg bg-emerald-500 px-3 py-2 text-slate-50 hover:bg-emerald-800">Atualizar</button>
                </div>

            </form>
        </div>
    </div>
</x-midas-layout>
