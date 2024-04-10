@props(['page', 'area', 'rota'])
<div class="flex flex-row items-center justify-center bg-transparent py-3">
    <div class="flex items-center rounded-full bg-white">
        <div class="flex items-center">
            <a href="{{ route('admin') }}" class="rounded-l-full rounded-r-full border-l-2 border-r-2 border-l-slate-700 border-r-slate-700 bg-transparent px-6 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-heart-fill h-6 w-6 text-slate-500 hover:text-yellow-500"
                    viewBox="0 0 16 16">
                    <path
                        d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z" />
                    <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018" />
                </svg>
            </a>
        </div>
        <div class="bg-transarent flex items-center bg-slate-700">
            <a href="{{ route($rota) }}"
                class="rounded-r-full border-r-2 border-r-slate-700 bg-white px-6 py-2 font-thin text-slate-400 hover:text-yellow-500">{{ $area }}</a>
        </div>
        <div class="flex items-center">
            <span class="rounded-r-full bg-slate-700 px-6 py-2 font-semibold text-stone-100">{{ $page }}</span>
        </div>
    </div>
</div>
