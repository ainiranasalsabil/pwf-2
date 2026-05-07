<nav x-data="{ open: false }" 
     class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    {{-- x-data digunakan untuk toggle menu mobile --}}
    {{-- open = false berarti menu mobile default tertutup --}}
    {{-- class digunakan untuk styling navbar (light & dark mode) --}}

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- container utama dengan padding responsive --}}

        <div class="flex justify-between h-16">
            {{-- flex untuk memisahkan kiri dan kanan navbar --}}

            {{-- ================= LEFT SIDE ================= --}}
            <div class="flex">

                {{-- LOGO --}}
                <div class="shrink-0 flex items-center">
                    {{-- shrink-0 supaya logo tidak mengecil --}}
                    <a href="{{ route('dashboard') }}">
                        {{-- klik logo akan menuju dashboard --}}
                        <x-application-logo 
                            class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        {{-- component logo --}}
                    </a>
                </div>

                {{-- ================= MENU DESKTOP ================= --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- hidden di mobile, tampil di layar besar --}}
                    {{-- space-x-8 untuk jarak antar menu --}}

                    {{-- DASHBOARD --}}
                    <x-nav-link 
                        :href="route('dashboard')" 
                        :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>
                    {{-- route menuju dashboard --}}
                    {{-- routeIs untuk cek menu aktif --}}

                    {{-- PRODUCT (SEMUA USER BOLEH) --}}
                    <x-nav-link 
                        :href="route('product.index')" 
                        :active="request()->routeIs('product.*')">
                        Product
                    </x-nav-link>
                    {{-- semua user bisa akses product --}}

                    {{-- CATEGORY (HANYA ADMIN) --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link 
                            :href="route('kategoris.index')" 
                            :active="request()->routeIs('kategoris.*')">
                            Category
                        </x-nav-link>
                    @endif
                    {{-- hanya admin yang bisa melihat menu category --}}

                    {{-- ABOUT --}}
                    <x-nav-link 
                        :href="route('about')" 
                        :active="request()->routeIs('about')">
                        About
                    </x-nav-link>

                </div>
            </div>

            {{-- ================= RIGHT SIDE ================= --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- hanya tampil di desktop --}}

                <x-dropdown align="right" width="48">
                    {{-- dropdown user --}}

                    {{-- TRIGGER --}}
                    <x-slot name="trigger">
                        <button 
                            class="inline-flex items-center px-3 py-2 text-sm font-medium 
                                   text-gray-500 dark:text-gray-400 
                                   bg-white dark:bg-gray-800 
                                   hover:text-gray-700 dark:hover:text-gray-300">

                            <div>{{ Auth::user()->name }}</div>
                            {{-- menampilkan nama user login --}}
                        </button>
                    </x-slot>

                    {{-- CONTENT DROPDOWN --}}
                    <x-slot name="content">

                        {{-- PROFILE --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        {{-- LOGOUT --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            {{-- csrf untuk keamanan --}}

                            <x-dropdown-link 
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                            {{-- preventDefault mencegah GET --}}
                            {{-- submit digunakan untuk POST logout --}}
                        </form>

                    </x-slot>

                </x-dropdown>
            </div>

            {{-- ================= HAMBURGER MENU (MOBILE) ================= --}}
            <div class="-me-2 flex items-center sm:hidden">
                {{-- hanya tampil di mobile --}}

                <button @click="open = ! open" 
                        class="p-2 text-gray-400 dark:text-gray-500">
                    {{-- klik akan toggle open true/false --}}

                    <svg class="h-6 w-6" viewBox="0 0 24 24">
                        {{-- icon menu --}}

                        <path :class="{'hidden': open}" 
                              d="M4 6h16M4 12h16M4 18h16" />
                        {{-- icon garis (menu) --}}

                        <path :class="{'hidden': ! open}" 
                              d="M6 18L18 6M6 6l12 12" />
                        {{-- icon X (close) --}}
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- ================= MOBILE MENU ================= --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        {{-- tampil jika open = true --}}

        <div class="pt-2 pb-3 space-y-1">

            {{-- DASHBOARD --}}
            <x-responsive-nav-link 
                :href="route('dashboard')" 
                :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            {{-- PRODUCT --}}
            <x-responsive-nav-link 
                :href="route('product.index')" 
                :active="request()->routeIs('product.*')">
                Product
            </x-responsive-nav-link>
            {{-- semua user bisa akses --}}

            {{-- CATEGORY (HANYA ADMIN) --}}
            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link 
                    :href="route('kategoris.index')" 
                    :active="request()->routeIs('kategoris.*')">
                    Category
                </x-responsive-nav-link>
            @endif
            {{-- hanya admin yang bisa melihat kategori --}}

            {{-- ABOUT --}}
            <x-responsive-nav-link 
                :href="route('about')" 
                :active="request()->routeIs('about')">
                About
            </x-responsive-nav-link>

        </div>

        {{-- USER INFO MOBILE --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                    {{ Auth::user()->name }}
                </div>
                {{-- nama user --}}

                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
                {{-- email user --}}
            </div>

            <div class="mt-3 space-y-1">

                {{-- PROFILE --}}
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link 
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>

</nav>