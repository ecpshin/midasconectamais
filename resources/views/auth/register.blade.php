<x-autenticar-layout>
    <div class="mx-auto w-5/6 rounded-xl bg-[#a11d0c] bg-opacity-70 px-4 py-8 shadow-xl shadow-[#000000] md:w-3/4 lg:w-2/3 xl:w-[600px] 2xl:w-[650px]">

        <h2 class="text-center text-2xl font-bold tracking-wide text-gray-100">Sign Up</h2>
        <p class="mt-2 text-center text-sm text-gray-100">Já possui registro? <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark hover:underline"
                title="Sign In">Faça o login.</a></p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label class="text-white" for="name" :value="__('Name')" />
                <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Email Address -->
            <div class="mt-2">
                <x-input-label class="text-white" for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="row mt-2">
                <div class="col-lg-6 mt-4">
                    <x-input-label class="text-white" for="password" :value="__('Password')" />

                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="col-lg-6 mt-4">
                    <x-input-label class="text-white" for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-6">
                    <x-input-label class="text-white" for="data_nascimento" :value="__('Data Nascimento')" />
                    <x-text-input id="data_nascimento" class="mt-1 block w-full" type="date" name="data_nascimento" :value="old('data_nascimento')" autocomplete="data_nascimento" />
                    <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                </div>

                <div class="col-lg-6">
                    <x-input-label class="text-white" for="phone" :value="__('Tel. Contato')" />
                    <x-text-input id="phone" class="mt-1 block w-full" type="text" name="phone" :value="old('phone')" autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-2">
                    <x-input-label class="text-white" for="codigo" :value="__('Código')" />
                    <x-text-input id="codigo" class="mt-1 block w-full" type="text" name="codigo" :value="old('codigo')" autocomplete="codigo" />
                    <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                </div>
                <div class="col-lg-8">
                    <x-input-label class="text-white" for="banco" :value="__('Banco')" />
                    <x-text-input id="banco" class="mt-1 block w-full" type="text" name="banco" :value="old('banco')" autocomplete="banco" />
                    <x-input-error :messages="$errors->get('banco')" class="mt-2" />
                </div>
                <div class="col-lg-2">
                    <x-input-label class="text-white" for="agencia" :value="__('Agência')" />
                    <x-text-input id="agencia" class="mt-1 block w-full" type="text" name="agencia" :value="old('agencia')" autocomplete="agencia" />
                    <x-input-error :messages="$errors->get('agencia')" class="mt-2" />
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-6">
                    <x-input-label class="text-white" for="tipo_conta" :value="__('Tipo Conta')" />
                    <x-text-input id="tipo_conta" class="mt-1 block w-full" type="text" name="tipo_conta" :value="old('tipo_conta')" autocomplete="tipo_conta" />
                    <x-input-error :messages="$errors->get('tipo_conta')" class="mt-2" />
                </div>
                <div class="col-lg-6">
                    <x-input-label class="text-white" for="codigo_op" :value="__('Operação')" />
                    <x-text-input id="codigo_op" class="mt-1 block w-full" type="text" name="codigo_op" :value="old('codigo_op')" autocomplete="codigo_op" />
                    <x-input-error :messages="$errors->get('codigo_op')" class="mt-2" />
                </div>
            </div>
            <div class="row mb-4 mt-2">
                <div class="col-lg-6">
                    <x-input-label class="text-white" for="tipo_chave_pix" :value="__('Tipo Chave PIX')" />
                    <x-text-input id="tipo_chave_pix" class="mt-1 block w-full" type="text" name="tipo_chave_pix" :value="old('tipo_chave_pix')" autocomplete="tipo_chave_pix" />
                    <x-input-error :messages="$errors->get('tipo_chave_pix')" class="mt-2" />
                </div>
                <div class="col-lg-6">
                    <x-input-label class="text-white" for="chave_pix" :value="__('Chave PIX')" />
                    <x-text-input id="chave_pix" class="mt-1 block w-full" type="text" name="chave_pix" :value="old('chave_pix')" autocomplete="chave_pix" />
                    <x-input-error :messages="$errors->get('chave_pix')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a class="rounded-md text-sm text-gray-100 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    href="{{ route('login') }}">
                    {{ __('Já é registrado?') }}
                </a>

                <button class="ml=3 bg-primary hover:bg-primary-dark rounded-lg px-8 py-2 text-gray-100 transition duration-150 hover:shadow-xl">{{ __('Registrar-se') }}</button>
            </div>
        </form>
    </div>
    <div class="media_hidden">
        <x-register-logo />
    </div>
</x-autenticar-layout>
