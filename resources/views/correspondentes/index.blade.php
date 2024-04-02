<x-midas-layout>
    <x-slot name="header">
        <x-bread page="{{ $page }}" area="{{ $area }}" rota="{{ $rota }}"></x-bread>
    </x-slot>

    <div class="w-full">
        <div class="mx-auto w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <!-- start::Advance Table Manage Icons -->
                    <div class="custom-scrollbar mb-12 overflow-x-scroll rounded-lg bg-white px-8 py-6">
                        <a href="{{ route('admin.correspondentes.create') }}" role="button"
                            class="rounded-md bg-emerald-700 px-3 py-2 text-slate-300 shadow-xl shadow-black hover:bg-emerald-900">Adicionar</a>
                        <table class="my-8 w-full whitespace-nowrap">
                            <thead class="bg-red-700 font-bold text-slate-100">
                                <td>
                                </td>
                                <td class="py-2 pl-2">ID</td>
                                <td class="py-2 pl-2">Nome Correspondente</td>
                                <td class="py-2 pl-2">Nome Reponsável</td>
                                <td class="py-2 pl-2">Contato</td>
                                <td class="py-2 pl-2">CPF/CNPJ</td>
                                <td class="py-2 pl-2"></td>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($correspondentes as $correspondente)
                                    <tr class="bg-gray-200 transition duration-200 even:bg-slate-50 hover:bg-red-400 hover:bg-opacity-20">
                                        <td class="py-3 pl-2">
                                            <input type="checkbox" class="ml-2 rounded checked:bg-red-500 focus:ring-0">
                                        </td>
                                        <td class="py-3 pl-2">{{ $correspondente->id }}</td>
                                        <td class="py-3 pl-2 capitalize">{{ $correspondente->nome_correspondente }}</td>
                                        <td class="py-3 pl-2 capitalize">{{ $correspondente->nome_responsavel }}</td>
                                        <td class="py-3 pl-2 capitalize">{{ $correspondente->phone_contato }}</td>
                                        <td class="py-3 pl-2 capitalize">{{ $correspondente->cpf_cnpj }}</td>
                                        <td class="flex items-center space-x-1 py-3 pl-2">
                                            <a href="{{ route('admin.correspondentes.show', $correspondente) }}"
                                                class="rounded-md bg-sky-800 px-2 py-2 shadow-md shadow-slate-500 hover:bg-sky-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50 hover:text-slate-50" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.correspondentes.edit', $correspondente) }}"
                                                class="rounded-md bg-yellow-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-yellow-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <a href="#" class="rounded-md bg-red-700 px-2 py-2 shadow-md shadow-slate-500 hover:bg-red-900" onclick="confirmar('{{$correspondente->id}}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <form action="{{ route('admin.correspondentes.destroy', $correspondente) }}" id="form_{{$correspondente->id}}" method="post">
                                                    @csrf @method('DELETE')
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100 h-auto rounded-md bg-slate-300 px-3 py-3">
                        {{ $correspondentes->links() }}
                    </div>
                    <!-- end::Advance Table Manage Icons -->
                </div>
            </div>
        </div>
    </div>
</x-midas-layout>
