<!-- start::Topbar -->
<div class="flex flex-col">
    <header class="mr-16 flex h-16 flex-row items-center justify-between bg-white">
        @if ($header)
            {{ $header }}
        @endif
        <!-- start::Mobile menu button -->
        <div class="flex items-center">
            <button @click="menuOpen = true" class="hover:text-primary xl:show text-gray-500 transition duration-200 focus:outline-none lg:hidden">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                </svg>
            </button>
        </div>
        <!-- end::Mobile menu button -->

        <!-- start::Right side top menu -->
        <div class="flex items-center">
            <h1 class="text-nowrap mr-5 rounded-md py-2 text-center text-sm font-semibold text-black">
                {{ Auth::user()->name }}
            </h1>
            <!-- start::Profile -->
            <div x-data="{ linkActive: false }" class="relative">
                <!-- start::Main link -->
                <div @click="linkActive = !linkActive" class="cursor-pointer">
                    <img src="{{ asset('img/user.png') }}" class="w-10 rounded-full" />
                </div>
                <!-- end::Main link -->

                <!-- start::Submenu -->
                <div x-show="linkActive" @click.away="linkActive = false" x-cloak class="absolute right-0 top-11 z-20 w-40 border border-gray-300">
                    <!-- start::Submenu content -->
                    <div class="rounded-md bg-white">
                        <!-- start::Submenu link -->
                        <a x-data="{ linkHover: false }" href="{{ route('profile.edit') }}" class="flex items-center justify-between bg-opacity-20 px-3 py-2 hover:bg-gray-100"
                            @mouseover="linkHover = true" @mouseleave="linkHover = false">
                            <div class="flex items-center">
                                <svg class="text-primary h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                                <div class="ml-3 text-sm">
                                    <p class="font-bold capitalize text-gray-600" :class="linkHover ? 'text-primary' : ''">
                                        Perfil
                                    </p>
                                </div>
                            </div>
                        </a>
                        <!-- end::Submenu link -->

                        <!-- start::Submenu link -->
                        <a x-data="{ linkHover: false }" href="#" class="flex items-center justify-between bg-opacity-20 px-3 py-2 hover:bg-gray-100" @mouseover="linkHover = true"
                            @mouseleave="linkHover = false">
                            <div class="flex items-center">
                                <svg class="text-primary h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div class="ml-3 text-sm">
                                    <p class="font-bold capitalize text-gray-600" :class="linkHover ? 'text-primary' : ''">
                                        Settings
                                    </p>
                                </div>
                            </div>
                        </a>
                        <!-- end::Submenu link -->

                        <hr />

                        <!-- start::Submenu link -->
                        <form method="POST" action="{{ route('logout') }}" x-data="{ linkHover: false }"
                            class="flex items-center justify-between bg-opacity-20 px-3 py-2 hover:bg-gray-100" @mouseover="linkHover = true" @mouseleave="linkHover = false">
                            @csrf
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <button class="ml-3 text-sm font-bold capitalize text-gray-600" :class="linkHover ? 'text-red-500' : ''">
                                    Log out
                                </button>
                            </div>
                        </form>
                        <!-- end::Submenu link -->
                    </div>
                    <!-- end::Submenu content -->
                </div>
                <!-- end::Submenu -->
            </div>
            <!-- end::Profile -->
        </div>
        <!-- end::Right side top menu -->
    </header>
</div>
<!-- end::Topbar -->
