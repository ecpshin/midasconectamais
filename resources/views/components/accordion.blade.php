<div x-data="{ accordion1: true, accordion2: false, accordion3: false }">
    <div class="border border-gray-300 bg-red-700 px-4 text-white">
        <button @click="
            accordion2 = false,
            accordion3 = false,
            accordion1 = !accordion1"
            class="hover:text-primary flex w-full items-center py-2 text-left" :class="accordion1 ? 'text-primary' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" class="hover:text-primary h-6 w-6" :class="accordion1 ? 'hidden' : 'block'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="hover:text-primary h-6 w-6" :class="accordion1 ? 'block' : 'hidden'" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="ml-2">Dados Pessoais</p>
        </button>
        <div x-show="accordion1" x-cloak x-collapse.duration.500ms>
            <div class="py-2">

            </div>
        </div>
    </div>
    <div class="border border-gray-300 px-4">
        <button @click="
             accordion1 = false,
             accordion3 = false,
             accordion2 = !accordion2
         "
            class="hover:text-primary flex w-full items-center py-2 text-left" :class="accordion2 ? 'text-primary' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" class="hover:text-primary h-6 w-6" :class="accordion2 ? 'hidden' : 'block'" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="hover:text-primary h-6 w-6" :class="accordion2 ? 'block' : 'hidden'" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="ml-2">Accordion Item 2</p>
        </button>
        <div x-show="accordion2" x-cloak x-collapse.duration.500ms>
            <div class="py-2">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                inventore
                veritatis et
                quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur
                magni dolores
                eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.
            </div>
        </div>
    </div>
    <div class="border border-gray-300 px-4">
        <button @click="
             accordion1 = false,
             accordion2 = false,
             accordion3 = !accordion3
         "
            class="hover:text-primary flex w-full items-center py-2 text-left" :class="accordion3 ? 'text-primary' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" class="hover:text-primary h-6 w-6" :class="accordion3 ? 'hidden' : 'block'" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="hover:text-primary h-6 w-6" :class="accordion3 ? 'block' : 'hidden'" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="ml-2">Accordion Item 3</p>
        </button>
        <div x-show="accordion3" x-cloak x-collapse.duration.500ms>
            <div class="py-2">
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
                molestias
                excepturi
                sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum
                quidem
                rerum facilis
                est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil.
            </div>
        </div>
    </div>
</div>
