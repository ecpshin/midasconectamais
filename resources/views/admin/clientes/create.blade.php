<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>
    <div class="mx-auto w-full px-8 py-8">
        <div class="overflow-hidden bg-white p-3 shadow-sm shadow-slate-700 sm:rounded-lg">
            <form action="{{ route('admin.clientes.store') }}" method="post" class="flex flex-col px-3">@csrf
                <fieldset x-show="true" title="Dados pessoais" class="mb-3 flex flex-col gap-2 rounded-lg p-4 outline outline-1 outline-slate-700">
                    <h3 class="rounded bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Pessoais</h3>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-6 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="nome">Nome Completo</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome completo">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" maxlength="14" size="14" required value="{{ old('cpf') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="CPF">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="data_nascimento">Data Nasc.</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                title="Data de nascimento">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="rg">RG</label>
                            <input type="text" name="rg" id="rg" value="{{ old('rg') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="RG">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="orgao_exp">Órgão Exp</label>
                            <input type="text" name="orgao_exp" id="orgao_exp" value="{{ old('orgao_exp') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Órgão expedidor">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="data_exp">Data Exp.</label>
                            <input type="date" name="data_exp" id="data_exp" value="{{ old('data_exp') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                title="Data da expedição">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="naturalidade">Naturalidade</label>
                            <input type="text" name="naturalidade" id="naturalidade" value="{{ old('naturalidade') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Naturalidade">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 py-2">
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="genitora">Nome da Mãe</label>
                            <input type="text" name="genitora" id="genitora" value="{{ old('genitora') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome da mãe">
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="genitor">Nome do Pai</label>
                            <input type="text" name="genitor" id="genitor" value="{{ old('genitor') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Nome do pai">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="sexo">Sexo</label>
                            <select name="sexo" id="sexo" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="Masculino">Selecione</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Não Binário (LGBTQI+)">Não Binário (LGBTQI+)</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="estado_civil">Estado Civil</label>
                            <select name="estado_civil" id="estado_civil" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="Não definido">Selecione</option>
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
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="phone1">Tel. Principal</label>
                            <input type="text" name="phone1" id="phone1" value="{{ old('phone1') }}"
                                class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="phone2">Tel. Família</label>
                            <input type="text" name="phone2" id="phone2" value="{{ old('phone2') }}"
                                class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="phone3">Tel. Recado 1</label>
                            <input type="text" name="phone3" id="phone3" value="{{ old('phone3') }}"
                                class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="phone">Tel. Recado 2</label>
                            <input type="text" name="phone4" id="phone4" value="{{ old('phone4') }}"
                                class="phone rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="(84)9 9999-9999">
                        </div>
                    </div>
                </fieldset>
                {{-- InfoResidenciais --}}
                <fieldset title="Informações Residenciais" class="mb-4 flex flex-col gap-2 rounded-lg p-4 outline outline-1 outline-slate-700">
                    <h3 class="rounded bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Residenciais</h3>
                    <div class="row mx-3 mt-2 justify-between">
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="buscaCep">CEP</label>
                            <input type="search" name="cep" id="buscaCep" value="{{ old('cep') }}" size="10" maxlength="8"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="59000000">
                        </div>
                        <div class="col-lg-6 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="logradouro">Endereço, nº</label>
                            <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Rua Tabajara, 10">
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="complemento">Complemento</label>
                            <input type="text" name="complemento" id="complemento" value="{{ old('complemento') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Ex.: Condomínio das Acácias Bloco 2 Apto. 503 5º Andar">
                        </div>
                    </div>
                    <div class="row mx-3 mt-2 justify-between">
                        <div class="col-lg-5 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="bairro">Bairro</label>
                            <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="Bairro">
                        </div>
                        <div class="col-lg-5 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="localidade">Cidade</label>
                            <input type="text" name="localidade" id="localidade" value="{{ old('localidade') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="Cidade">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="uf">UF</label>
                            <input type="text" name="uf" id="uf" value="{{ old('uf') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="RN">
                        </div>
                    </div>
                </fieldset>
                {{-- InfoFuncionais --}}
                <fieldset title="Info Funcionais" class="mb-4 flex flex-col gap-2 rounded-lg p-4 outline outline-1 outline-slate-700">
                    <h3 class="rounded bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Funcionais</h3>
                    <div class="row mx-3 flex flex-row justify-between px-3 pb-3">
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="organizacao_id">Órgão</label>
                            <select name="organizacao_id" id="organizacao_id" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                @forelse ($orgaos as $orgao)
                                    <option value="{{ $orgao->id }}">{{ $orgao->nome_organizacao }}</option>
                                @empty
                                    <option value="1">Não há órgãos cadastrados</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="nrbeneficio">Nº Benefício | Matrícula</label>
                            <input type="text" name="nrbeneficio" id="nrbeneficio" value="{{ old('nrbeneficio') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Número do benefício ou matrícula">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="Senha e e-mails">Emails</label>
                            <input id="email" name="email" type="email" value="{{ old('email', 'cliente@email.com') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="Email">
                        </div>
                        <div class="col-lg-3 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="Senha e e-mails">Senha</label>
                            <input type="text" id="senha" name="senha" value="{{ old('senha', '*********') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="Senhas">
                        </div>
                    </div>
                </fieldset>

                <fieldset title="infoBancárias" class="mb-4 flex flex-col gap-2 rounded-lg p-2 outline outline-1 outline-slate-700">
                    <h3 class="rounded bg-gradient-to-br from-slate-900 via-slate-700 to-indigo-700 py-2 text-center text-lg text-slate-50">Dados Bancários</h3>
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="codigo">Código</label>
                            <input type="search" name="codigo" id="buscaBanco" value="{{ old('codigo') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="001">
                        </div>
                        <div class="col-lg-8 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="banco">Nome Banco</label>
                            <input type="text" name="banco" id="banco" value="{{ old('banco') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Banco da Caixola S.A.">
                        </div>
                        <div class="col-lg-2 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="agencia">Agência</label>
                            <input type="text" name="agencia" id="agencia" value="{{ old('agencia') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0" placeholder="0000-x">
                        </div>
                    </div>
                    <div class="row mx-3 justify-between px-3 pb-3">
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="conta">Conta</label>
                            <input type="text" name="conta" id="conta" value="{{ old('conta') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Ex.: 12313-5">
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="tipo_conta">Tipo Conta</label>
                            <select name="tipo_conta" id="tipo_conta" class="rounded border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="Conta Corrente">Selecione</option>
                                <option value="Conta Corrente">Conta Corrente</option>
                                <option value="Conta Poupança">Conta Poupança</option>
                                <option value="Conta Salário">Conta Salário</option>
                                <option value="Conta Benefício">Conta Benefício</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-2 flex flex-col">
                            <label class="text-sm text-slate-500" for="operacao">Operação</label>
                            <input type="text" name="operacao" id="operacao" value="{{ old('operacao') }}"
                                class="rounded border-gray-300 py-1 placeholder:text-slate-400 focus:border-gray-300 focus:outline-emerald-300 focus:ring-0"
                                placeholder="Código ou nome da operação">
                        </div>
                    </div>
                </fieldset>

                <div class="my-3 flex items-center justify-center gap-2">
                    <button type="submit"
                        class="rounded-lg bg-emerald-500 px-6 py-1.5 text-gray-100 transition duration-150 hover:bg-emerald-900 hover:text-slate-50 hover:shadow-xl">Salvar</button>
                    <button type="reset" class="rounded-lg bg-red-700 px-6 py-1.5 text-slate-100 transition duration-150 hover:bg-opacity-70 hover:shadow-xl">Limpar</button>
                </div>
            </form>

        </div>
    </div>
</x-midas-layout>
