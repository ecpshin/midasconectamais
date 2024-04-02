<x-autenticar-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mx-auto mt-8 w-5/6 rounded-xl bg-[#38342c] bg-opacity-70 px-10 py-8 shadow-xl shadow-[#000000] md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px]">
        <h2 class="text-center text-2xl font-bold tracking-wide text-white">Sign In</h2>
        <p class="mt-2 text-center text-sm text-white">
            Não tem uma conta?
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-slate-100 hover:underline" title="Sign Up">Registrar-se</a>
        </p>

        <form class="px-8 py-8 text-sm" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="my-4 flex w-full flex-col gap-2">
                <label for="email" class="text-white">Email</label>
                <input type="email" name="email" id="email"
                    class="flex-1 rounded border-gray-300 py-2 pr-10 text-sm text-gray-900 focus:border-gray-300 focus:outline-none focus:ring-0" placeholder="Digite seu email">
            </div>

            <div class="my-4 flex flex-col gap-2">
                <label for="password" class="text-white">Senha</label>
                <div x-data="{ show: false }" class="relative flex items-center">
                    <input :type="show ? 'text' : 'password'" name="password" id="password"
                        class="flex-1 rounded border-gray-300 py-2 pr-10 text-sm text-gray-900 focus:border-gray-300 focus:outline-none focus:ring-0" placeholder="Digite sua senha"
                        type="password">
                    <button @click="show = !show" type="button" class="absolute right-1 flex items-center justify-center bg-transparent text-white">
                        <svg x-show="!show" class="h-5 w-5" fill="none" stroke="#000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                            </path>
                        </svg>

                        <svg x-show="show" class="h-5 w-5" fill="none" stroke="#000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember_me" id="remember_me" class="mr-2 rounded focus:ring-0">
                <label for="remember_me" class="text-white">Manter-me conectado</label>
            </div>

            <div class="my-4 flex items-center justify-end space-x-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-white hover:text-white hover:underline">Esqueceu a senha?</a>
                @endif
                <button class="rounded-lg bg-blue-500 px-8 py-2 uppercase text-white transition duration-150 hover:bg-blue-700 hover:shadow-xl">Sign In</button>
            </div>
        </form>
    </div>
    <div class="media_hidden">
        <x-auth-logo />
    </div>
</x-autenticar-layout>
