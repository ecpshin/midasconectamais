<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.roles.update', $role) }}" class="mt-3" method="post">
                        @csrf @method('PATCH')
                        <div class="mb-3 flex flex-col">
                            <label for="name" class="text-black">Nome</label>
                            <input type="text" name="name" id="name" value="{{ $role->name }}"
                                class="rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('name')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="mb-3 flex flex-col">
                            <label for="guard" class="text-black">Guarda</label>
                            <select name="guard_name" id="guard_name" class="rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="{{ $role->id }}" selected>{{ $role->guard_name }}</option>
                                <option value="web">Web</option>
                                <option value="api">API</option>
                            </select>
                            @error('guard_name')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-row flex-wrap justify-evenly">
                            @foreach ($rolePermissions as $rp)
                                <div class="col-lg-3 flex items-center gap-1">
                                    <input type="checkbox" name="permissions[]" id="perm_{{ $rp->id }}" value="{{ $rp->name }}" class="h-4 w-4 rounded-full" checked>
                                    <label for="permissions" class="text-sm">{{ $rp->name }}</label>
                                </div>
                            @endforeach
                            @foreach ($perms as $perm)
                                <div class="col-lg-3 flex items-center gap-1">
                                    <input type="checkbox" name="permissions[]" id="perm_{{ $perm->id }}" value="{{ $perm->name }}" class="h-4 w-4 rounded-full">
                                    <label for="permissions" class="text-sm">{{ $perm->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <button
                                class="mt-3 rounded-full bg-emerald-900 px-6 py-1.5 text-sm text-slate-50 transition duration-150 hover:bg-emerald-500 hover:text-slate-50 hover:shadow-xl">
                                <i class="bi bi-floppy mr-1"></i>
                                Atualizar
                            </button>
                            <a href="{{ route('admin.roles.index') }}" role="button"
                                class="mt-3 rounded-full bg-slate-300 px-6 py-1.5 text-sm text-gray-500 transition duration-150 hover:bg-blue-700 hover:text-slate-50 hover:shadow-xl"><i
                                    class="bi bi-arrow-counterclockwise"></i> Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
