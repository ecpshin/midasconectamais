<div class="modal fixed left-0 top-0 z-50 flex h-screen w-full items-center justify-center bg-black bg-opacity-50">
    <div class="shodow-lg w-1/3 rounded bg-white">
        <div class="border-b px-4 py-2">
            <h1>Modal Title</h1>
        </div>
        <div class="p-3">
            {{ $slot }}
        </div>
        <div class="w-100 flex items-center justify-end gap-1 border-t px-10 py-5">
            <button class="rounded-md bg-blue-700 px-3 py-1 text-sm text-white hover:bg-blue-600">Ok</button>
            <button class="close-modal rounded-md bg-red-700 px-3 py-1 text-sm text-white hover:bg-red-600" @click="show=!show">Cancel</button>
        </div>
    </div>
</div>
