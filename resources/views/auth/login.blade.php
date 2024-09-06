<x-autenticar-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="border-3 mx-auto mt-8 w-[480px] rounded-2xl border-[#321e2e] bg-[#000] bg-opacity-25 px-10 py-8">
        <h2 class="text-center text-2xl font-bold tracking-wide text-white">Seleção de Painel</h2>
        <p class="mt-2 text-center text-sm text-white">
            Para acessar é necesário selecionar um painel
        </p>

        <div class="w-100 flex flex-col items-center mt-16 mb-16 p-3 space-y-5">

            <a href="{{route('filament.midas.auth.login')}}" class="rounded-full w-100 font-semibold bg-[#3f3d3d] hover:bg-[#683242] text-xl text-slate-50 text-center py-3">Painel Agente</a>

            <a href="{{route('filament.admin.auth.login')}}" class="rounded-full w-100 font-semibold bg-[#3f3d3d] hover:bg-[#313260] text-xl text-slate-50 text-center py-3">Painel de Administrador</a>

        </div>

    </div>
    <div class="media_hidden">
        <x-auth-logo />
    </div>
</x-autenticar-layout>
