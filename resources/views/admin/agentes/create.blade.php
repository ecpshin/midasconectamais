<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota" />
    </x-slot>

    <div class="w-75 mx-auto sm:px-4 lg:px-6">
        <div class="mx-auto mt-5 max-w-7xl rounded-lg bg-white px-5 py-5 shadow-xl shadow-yellow-900">
            <h2 class="text-center text-2xl font-bold tracking-wide text-gray-700">Registro de Agente</h2>

            <form method="POST" action="{{ route('admin.agentes.store') }}" class="border-1 mt-3 rounded-xl border-red-500 px-3 py-2">
                @csrf
                <div class="row mt-3">
                    <!-- Name -->
                    <div class="col-lg-5 mt-3">
                        <x-input-label class="text-gray-700" for="name" :value="__('Name')" />
                        <x-text-input id="name" class="mt-1 block w-full py-1 text-sm" type="text" name="name" :value="old('name')" required autofocus
                            autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Email Address -->
                    <div class="col-lg-4 mt-3">
                        <x-input-label class="text-gray-700" for="email" :value="__('Email')" />
                        <x-text-input id="email" class="mt-1 block w-full py-1 text-sm" type="email" name="email" :value="old('email')" required autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- CPF -->
                    <div class="col-lg-3 mt-3">
                        <x-input-label class="text-gray-700" for="cpf" :value="__('CPF')" />
                        <x-text-input id="text" class="cpf mt-1 block w-full py-1 text-sm" type="text" name="cpf" :value="old('cpf')" required autocomplete="cpf" />
                        <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                    </div>
                </div>
                <!-- Senha -->
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <x-input-label class="text-gray-700" for="password" :value="__('Password')" />

                        <x-text-input id="password" class="mt-1 block w-full py-1 text-sm" type="password" name="password" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="col-lg-6">
                        <x-input-label class="text-gray-700" for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="mt-1 block w-full py-1 text-sm" type="password" name="password_confirmation" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-6">
                        <x-input-label class="text-gray-700" for="data_nascimento" :value="__('Data Nascimento')" />
                        <x-text-input id="data_nascimento" class="mt-1 block w-full py-1 text-sm" type="date" name="data_nascimento" :value="old('data_nascimento')"
                            autocomplete="data_nascimento" />
                        <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                    </div>

                    <div class="col-lg-6">
                        <x-input-label class="text-gray-700" for="phone" :value="__('Tel. Contato')" />
                        <x-text-input id="phone" class="phone mt-1 block w-full py-1 text-sm" type="text" name="phone" :value="old('phone')" autocomplete="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-2">
                        <x-input-label class="text-gray-700" for="codigo" :value="__('Código')" />
                        <x-text-input id="buscaBanco" class="mt-1 block w-full py-1 text-sm" type="text" name="codigo" :value="old('codigo')" autocomplete="codigo" />
                        <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                    </div>
                    <div class="col-lg-5">
                        <x-input-label class="text-gray-700" for="banco" :value="__('Banco')" />
                        <x-text-input id="banco" class="mt-1 block w-full overflow-hidden text-ellipsis py-1 text-sm uppercase" type="text" name="banco" :value="old('banco')"
                            autocomplete="banco" />
                        <x-input-error :messages="$errors->get('banco')" class="mt-2" />
                    </div>
                    <div class="col-lg-2">
                        <x-input-label class="text-gray-700" for="conta" :value="__('Conta')" />
                        <x-text-input id="conta" class="mt-1 block w-full overflow-hidden text-ellipsis py-1 text-sm uppercase" type="text" name="conta" :value="old('conta')"
                            autocomplete="conta" />
                        <x-input-error :messages="$errors->get('banco')" class="mt-2" />
                    </div>
                    <div class="col-lg-3">
                        <x-input-label class="text-gray-700" for="agencia" :value="__('Agência')" />
                        <x-text-input id="agencia" class="mt-1 block w-full py-1 text-sm" type="text" name="agencia" :value="old('agencia')" autocomplete="agencia" />
                        <x-input-error :messages="$errors->get('agencia')" class="mt-2" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <x-input-label class="text-gray-700" for="tipo_conta" :value="__('Tipo Conta')" />
                        <x-text-input id="tipo_conta" class="mt-1 block w-full py-1 text-sm" type="text" name="tipo_conta" :value="old('tipo_conta')" autocomplete="tipo_conta" />
                        <x-input-error :messages="$errors->get('tipo_conta')" class="mt-2" />
                    </div>
                    <div class="col-lg-6">
                        <x-input-label class="text-gray-700" for="codigo_op" :value="__('Operação')" />
                        <x-text-input id="codigo_op" class="mt-1 block w-full py-1 text-sm" type="text" name="codigo_op" :value="old('codigo_op')" autocomplete="codigo_op" />
                        <x-input-error :messages="$errors->get('codigo_op')" class="mt-2" />
                    </div>
                </div>
                <div class="row mb-4 mt-3">
                    <div class="col-lg-6">
                        <x-input-label class="text-gray-700" for="tipo_chave_pix" :value="__('Tipo Chave PIX')" />
                        <x-text-input id="tipo_chave_pix" class="mt-1 block w-full py-1 text-sm" type="text" name="tipo_chave_pix" :value="old('tipo_chave_pix')"
                            autocomplete="tipo_chave_pix" />
                        <x-input-error :messages="$errors->get('tipo_chave_pix')" class="mt-2" />
                    </div>
                    <div class="col-lg-6">
                        <x-input-label class="text-gray-700" for="chave_pix" :value="__('Chave PIX')" />
                        <x-text-input id="chave_pix" class="mt-1 block w-full py-1 text-sm" type="text" name="chave_pix" :value="old('chave_pix')" autocomplete="chave_pix" />
                        <x-input-error :messages="$errors->get('chave_pix')" class="mt-2" />
                    </div>
                </div>
                <div class="mb-3 flex items-center justify-end gap-3">
                    <button
                        class="ml=3 rounded-lg bg-blue-500 px-5 py-2 text-sm text-gray-200 transition duration-150 hover:bg-green-900 hover:text-gray-50 hover:shadow-xl">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</x-midas-layout>
