<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota" />
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="mx-auto mt-5 max-w-7xl rounded-lg bg-white px-5 py-5 shadow-xl shadow-yellow-900">
                <h1 class="mb-3 text-center text-2xl">Perfil do Agente</h1>
                <form action="{{ route('admin.agentes.pessoais', $agente) }}" method="post" enctype="multipart/form-data" class="flex flex-col gap-3">
                    @csrf @method('PATCH')
                    <div class="border-1 flex flex-wrap gap-2 rounded-lg border-orange-600 p-3">
                        <div class="row mb-3 w-full">
                            <div class="col-lg-5 col-sm-12 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="name" :value="__('Nome')" />
                                <x-text-input type="text" name="name" id="name" value="{{ $agente->name }}" />
                            </div>
                            <div class="col-sm-12 col-lg-4 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="email" :value="__('E-mail')" />
                                <x-text-input type="email" name="email" id="email" value="{{ $agente->email }}" />
                            </div>
                            <div class="col-sm-12 col-lg-3 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="cpf" :value="__('CPF')" />
                                <x-text-input type="text" name="cpf" id="cpf" class="cpf" value="{{ $agente->cpf }}" />
                            </div>
                        </div>
                        <div class="row w-full">
                            <div class="col-lg-2 col-sm-12 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="data_nascimento" :value="__('Data Nascimento')" />
                                <x-text-input type="date" name="data_nascimento" id="data_nascimento" value="{{ $agente->data_nascimento->format('Y-m-d') }}" />
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="phone" :value="__('Contato')" />
                                <x-text-input type="text" name="phone" id="phone" class="phone" value="{{ $agente->phone }}" />
                            </div>
                        </div>
                    </div>
                    <div class="border-1 flex flex-wrap gap-2 rounded-lg border-orange-600 p-3">
                        <div class="flex w-full flex-col gap-2">
                            <x-input-label class="text-sm font-bold text-gray-900" for="file_input" :value="__('Upload de Foto')" />
                            <x-text-input type="file" name="picture" id="file_input" />
                        </div />
                    </div>
                    <div class="border-1 flex flex-wrap gap-2 rounded-lg border-orange-600 p-3">
                        <div class="row w-full">
                            <div class="col-lg-2 col-sm-12 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="codigo" :value="__('Código')" />
                                <x-text-input type="text" name="codigo" id="codigo" value="{{ $agente->codigo }}" />
                            </div>
                            <div class="col-sm-12 col-lg-5 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="banco" :value="__('Banco')" />
                                <x-text-input type="text" name="banco" id="banco" value="{{ $agente->banco }}" />
                            </div>
                            <div class="col-lg-2 col-sm-12 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="agencia" :value="__('Agência')" />
                                <x-text-input type="text" name="agencia" value="{{ $agente->agencia }}" />
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="conta" :value="__('Conta')" />
                                <x-text-input type="text" name="conta" id="conta" value="{{ $agente->conta }}" />
                            </div>
                        </div>
                        <div class="row w-full">
                            <div class="col-sm-12 col-lg-6 mb-3 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="tipo_conta" :value="__('Tipo Conta')" />
                                <x-text-input type="text" name="tipo_conta" id="tipo_conta" value="{{ $agente->tipo_conta }}" />
                            </div>
                            <div class="col-lg-6 col-sm-12 flex flex-col">
                                <x-input-label class="text-sm font-bold" for="codigo_op" :value="__('Operação')" />
                                <x-text-input type="text" name="codigo_op" value="{{ $agente->codigo_op }}" />
                            </div>
                        </div>
                    </div>
                    <div class="border-1 flex flex-row gap-2 rounded-lg border-orange-600 p-3">
                        <div class="col-lg-6 col-sm-12 mb-3 flex flex-col">
                            <x-input-label class="text-sm font-bold" for="tipo_chave_pix" :value="__('Tipo Chave PIX')" />
                            <x-text-input type="text" name="tipo_chave_pix" id="tipo_chave_pix" value="{{ $agente->tipo_chave_pix }}" />
                        </div>
                        <div class="col-lg-6 col-sm-12 flex flex-col">
                            <x-input-label class="text-sm font-bold" for="chave_pix" :value="__('Chave PIX')" />
                            <x-text-input type="text" name="chave_pix" id="chave_pix" value="{{ $agente->chave_pix }}" />
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="rounded-full bg-blue-900 px-4 py-2 text-sm text-white hover:bg-orange-700 hover:text-slate-500">Salvar</button>
                    </div>
                </form>
            </div>
            <div class="mx-auto mt-5 max-w-7xl rounded-lg bg-white px-5 py-5 shadow-xl shadow-yellow-900">
                <h1 class="mb-5 text-center text-2xl">Reset de Senha</h1>
                <form action="{{ route('admin.agentes.password', $agente) }}" method="post" class="flex flex-col gap-8">
                    @csrf @method('PATCH')
                    <div class="row flex w-full items-end">
                        <div class="col-sm-12 col-lg-5 flex flex-col gap-2">
                            <x-input-label class="text-sm font-bold" for="password" value="Senha" />
                            <x-text-input type="password" name="password" id="password" value="" />
                        </div>
                        <div class="col-sm-12 col-lg-5 flex flex-col gap-2">
                            <x-input-label class="text-sm font-bold" for="password_confirmation" value="Confirme a Senha" />
                            <x-text-input type="password" name="password_confirmation" id="password_confirmation" value="" />
                        </div>
                        <div class="col-lg-2 col-sm-12 p-1">
                            <button type="submit" class="rounded-full bg-blue-900 px-4 py-2 text-sm text-white hover:bg-orange-700 hover:text-slate-500">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Permissões e Roles --}}
            <div class="mx-auto mt-3 max-w-7xl rounded-lg bg-white px-5 py-5 shadow-xl shadow-yellow-900">
                <h1 class="mb-2 text-center text-2xl font-bold">Nível de Acesso {{ ucfirst($role[0]) }}</h1>
                <h1 class="mb-3 text-center text-xl font-semibold">Permissões do Agente</h1>
                <div class="mx-auto flex flex-col gap-8">
                    <form action="" method="post">
                        @csrf @method('PATCH')
                        <div class="flex flex-row flex-wrap justify-center gap-x-4 gap-y-2 rounded-xl border p-3">
                            @forelse ($permissions as $permission)
                                <input type="checkbox" id="permission_{{ $permission->id }}" value="{{ $permission->id }}" checked>
                                <x-input-label :value="__($permission->name)" for="permission_{{ $permission->id }}" />
                            @empty
                            @endforelse
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
