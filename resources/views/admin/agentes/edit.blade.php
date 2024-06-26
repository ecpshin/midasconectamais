<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="mx-auto mb-5 mt-5 max-w-7xl rounded-lg bg-white">
                <h4 class="rounded-t-lg bg-gradient-to-br from-slate-900 to-slate-700 py-2 text-center text-white">Perfil do Agente</h4>
                <form action="{{ route('admin.agentes.pessoais', $agente) }}" method="post" enctype="multipart/form-data" class="flex flex-col gap-3 p-4 text-indigo-900">
                    @csrf @method('PATCH')
                    <div class="row flex-column mb-3 flex items-center justify-center gap-3">
                        <img src="{{ asset('storage/' . $agente->path) }}" class="w-48" alt="User Image" style="border-radius: 15px;">
                    </div>
                    <div class="row space-between flex flex-row text-xs">
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" value="{{ $agente->name }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" value="{{ $agente->email }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" name="cpf" id="cpf" value="{{ $agente->cpf }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label for="data_nascimento" class="form-label">Data Nasc.</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" value="{{ $agente->data_nascimento }}"
                                class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                    </div>
                    <div class="row space-between flex flex-row text-xs">
                        <div class="col-lg-1 mb-3 flex flex-col">
                            <label for="codigo" class="form-label">Código</label>
                            <input type="text" name="codigo" id="codigo" value="{{ $agente->codigo }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label for="banco" class="form-label">Banco</label>
                            <input type="text" name="banco" id="banco" value="{{ $agente->banco }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                        <div class="col-lg-1 mb-3 flex flex-col">
                            <label for="agencia" class="form-label">Agência</label>
                            <input type="text" name="agencia" id="agencia" value="{{ $agente->agencia }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label for="conta" class="form-label">Conta</label>
                            <input type="text" name="conta" id="conta" value="{{ $agente->conta }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label for="conta" class="form-label">Conta</label>
                            <select name="tipo_conta" id="tipo_conta" class="form-select rounded-lg border-slate-400 text-xs">
                                <option value="Conta Corrente">Conta Corrente</option>
                                <option value="Conta Poupança">Conta Poupança</option>
                                <option value="Conta Salário">Conta Salário</option>
                                <option value="Conta Benefício">Conta Benefício</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3 flex flex-col">
                            <label for="conta" class="form-label">Cód. Operação</label>
                            <input type="text" name="conta" id="conta" value="{{ $agente->codigo_op }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                    </div>
                    <div class="row space-between flex flex-row text-xs">
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label>Tipo</label>
                            <div class="form-input flex flex-row items-center justify-around rounded-lg border py-1 text-xs">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipo" id="agente" value="agente"
                                        @if ($agente->tipo == 'agente') checked @endif />
                                    <label class="form-check-label font-semibold" for="agente">Agente</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipo" id="corretor" value="corretor"
                                        @if ($agente->tipo != 'agente') checked @endif />
                                    <label class="form-check-label font-semibold" for="corretor">Corretor</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label for="phone" class="form-label">Contato</label>
                            <input type="text" name="phone" id="phone" value="{{ $agente->phone }}" class="form-input rounded-lg border-slate-400 text-xs">
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label class="form-label">Tipo Chave Pix</label>
                            <select name="tipo_chave_pix" id="tipo_chave_pix"" class="rounded-lg border-slate-400 text-xs">
                                <option value="CPF">CPF</option>
                                <option value="Email">Email</option>
                                <option value="Celular">Celular</option>
                                <option value="Chave aleatória">Chave aleatória</option>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-3 flex flex-col">
                            <label for="chave_pix" class="form-label">Chave Pix</label>
                            <input type="text" name="chave_pix" id="chave_pix" value="{{ $agente->chave_pix }}" class="rounded-lg border-slate-400 text-xs">
                        </div>

                        <div class="flex w-full items-center justify-center">
                            <label for="dropzone-file"
                                class="dark:hover:bg-bray-800 flex h-64 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                    <svg class="mb-4 h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para upload</span> ou arraste e drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="picture" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center">
                        <button type="submit" class="rounded-full bg-green-950 px-10 py-2 text-white">Salvar Dados</button>
                    </div>
                </form>
            </div>
            <div class="mx-auto mt-5 max-w-7xl rounded-lg bg-white">
                <h4 class="rounded-t-lg bg-gradient-to-br from-slate-900 to-slate-700 py-2 text-center text-white">Reset de Senha</h4>
                <form action="{{ route('admin.agentes.password', $agente) }}" method="post" class="flex flex-col gap-3 px-10 py-4">
                    @csrf @method('PATCH')
                    <div class="row flex flex-row">
                        <div class="col-lg-5 flex flex-col">
                            <input type="password" name="password" id="password" class="rounded-lg border-slate-400 text-xs" placeholder="Digite a senha" />
                        </div>
                        <div class="col-lg-5 flex flex-col gap-2">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="rounded-lg border-slate-400 text-xs"
                                placeholder="Confirme a senha" />
                        </div>
                        <div class="col-lg-2 flex flex-col">
                            <button type="submit" class="rounded-full bg-blue-900 px-4 py-2 text-sm text-white hover:bg-orange-700 hover:text-slate-500">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mx-auto mb-3 mt-3 max-w-7xl rounded-xl bg-white p-3">
                <h1 class="mb-2 text-center text-2xl font-bold">Nível de Acesso {{ ucfirst($role) }}</h1>
                <h1 class="mb-3 text-center text-xl font-semibold">Permissões</h1>
                <div class="mx-auto flex flex-col gap-8">
                    <form action="" method="post">
                        @csrf @method('PATCH')
                        <div class="flex flex-row flex-wrap justify-evenly rounded-xl border p-3">
                            @foreach ($rolePermissions as $rp)
                                <div class="col-lg-3 flex flex-row items-center">
                                    <input type="checkbox" id="rp_{{ $rp->id }}" class="mr-2 rounded-full" value="{{ $rp->id }}" checked>
                                    <x-input-label :value="__($rp->name)" for="rp_{{ $rp->id }}" />
                                </div>
                            @endforeach
                            @foreach ($perms as $perm)
                                <div class="col-lg-3 flex flex-row items-center space-x-2">
                                    <input type="checkbox" id="perm_{{ $perm->id }}" class="mr-2 rounded-full" value="{{ $perm->id }}">
                                    <x-input-label :value="__($perm->name)" for="perm_{{ $perm->id }}" />
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
