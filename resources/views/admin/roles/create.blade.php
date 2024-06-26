<x-midas-layout>
    <x-slot name="header">
        <x-bread :page="$page" :area="$area" :rota="$rota"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.roles.store') }}" class="mt-3" method="post">
                        @csrf
                        <div class="mb-3 flex flex-col">
                            <label for="name" class="text-xs text-black">Nome</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                            @error('name')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="mb-3 flex flex-col">
                            <label for="guard_name" class="text-black">Guarda</label>
                            <select name="guard_name" id="guard_name" class="rounded-lg border-gray-300 py-1 focus:border-gray-300 focus:outline-none focus:ring-0">
                                <option value="web">Web</option>
                                <option value="api">API</option>
                            </select>
                            @error('guard')
                                <span class="text-nowrap mb-3 mt-3 rounded-full bg-red-400 px-2 py-2 text-center text-sm text-white">{{ $message }}. Tecle [F5]</span>
                            @enderror
                        </div>
                        <div class="flex flex-row flex-wrap items-center justify-start">
                            @foreach ($permissions as $permission)
                                <div class="col-lg-2 flex items-center">
                                    <input name="permissions[]" type="checkbox" value="{{ $permission->name }}" id="perm_{{ $permission->id }}" class="h-4 w-4 rounded-full">
                                    <label for="perm_{{ $permission->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <button
                                class="mt-3 rounded-full bg-gray-300 px-6 py-1.5 text-sm text-gray-500 transition duration-150 hover:bg-green-700 hover:text-slate-50 hover:shadow-xl">
                                <i class="bi bi-floppy mr-1"></i>
                                Salvar
                            </button>
                            <a href="{{ route('admin.roles.index') }}" role="button"
                                class="mt-3 rounded-full bg-slate-300 px-6 py-2 text-sm text-gray-900 transition duration-150 hover:bg-blue-700 hover:text-slate-50 hover:shadow-xl"><i
                                    class="bi bi-arrow-counterclockwise"></i> Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
