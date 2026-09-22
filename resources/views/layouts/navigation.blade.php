<nav x-data="{ open: false }" class="sticky top-0 z-50 w-full rounded-2xl border border-gray-100 bg-white/90 shadow-sm backdrop-blur">
    <div class="mx-auto flex h-[72px] max-w-[1800px] items-center justify-between px-4 sm:px-6 lg:px-8 xl:px-10">
        <div class="flex w-[180px] shrink-0 items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-1 py-1 transition hover:bg-violet-50">
                <img src="{{ asset('images/dwi-putra.png') }}" alt="STT Dwi Putra" class="h-10 w-10 rounded-xl border border-slate-200 bg-white object-contain p-1 shadow-sm" />
                <div class="flex min-w-0 flex-col justify-center leading-none">
                    <p class="whitespace-nowrap text-[16px] font-bold text-slate-950">STT Dwi Putra</p>
                    <p class="mt-1 whitespace-nowrap text-[11px] font-normal text-slate-500">Sistem Informasi</p>
                </div>
            </a>
        </div>

        <div class="hidden flex-1 justify-center md:flex">
            <div class="flex flex-nowrap items-center gap-6 xl:gap-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
                <x-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')">Anggota</x-nav-link>
                <x-nav-link :href="route('inventaris.index')" :active="request()->routeIs('inventaris.*')">Inventaris</x-nav-link>
                <x-nav-link :href="route('kegiatan.index')" :active="request()->routeIs('kegiatan.*')">Kegiatan</x-nav-link>
                <x-nav-link :href="route('report.index')" :active="request()->routeIs('report.*')">Laporan</x-nav-link>
                <x-nav-link :href="route('profil')" :active="request()->routeIs('profil')">Profil</x-nav-link>
                <x-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">Galeri</x-nav-link>
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">Users</x-nav-link>
            </div>
        </div>

        <div class="hidden items-center gap-3 md:flex">
            <div class="hidden shrink-0 rounded-full bg-violet-50 px-4 py-2 text-right md:block">
                <p class="text-sm font-semibold text-slate-950">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
            </div>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center gap-3 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm transition duration-200 hover:border-slate-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-violet-500/20">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-violet-100 text-sm font-semibold text-violet-700">{{ strtoupper(Str::substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class="hidden sm:inline">Akun</span>
                        <svg class="h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <div class="flex items-center md:hidden">
            <button @click="open = ! open" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 shadow-sm transition duration-200 hover:bg-violet-50 hover:text-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 md:hidden" style="display: none;">
        <div class="fixed inset-0 bg-slate-950/40" @click="open = false"></div>
        <div class="fixed inset-y-0 left-0 flex w-full max-w-[85vw] flex-col bg-white p-4 shadow-2xl">
            <div class="flex items-center justify-between px-2 py-3">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/dwi-putra.png') }}" alt="STT Dwi Putra" class="h-10 w-10 rounded-xl border border-slate-200 bg-white object-contain p-1 shadow-sm" />
                    <div class="flex flex-col justify-center leading-none">
                        <p class="whitespace-nowrap text-[16px] font-bold text-slate-950">STT Dwi Putra</p>
                        <p class="mt-1 whitespace-nowrap text-[11px] font-normal text-slate-500">Sistem Informasi</p>
                    </div>
                </div>
                <button @click="open = false" class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-600 transition hover:bg-slate-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mt-6 space-y-2 px-2">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')">Anggota</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('inventaris.index')" :active="request()->routeIs('inventaris.*')">Inventaris</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kegiatan.index')" :active="request()->routeIs('kegiatan.*')">Kegiatan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('report.index')" :active="request()->routeIs('report.*')">Laporan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profil')" :active="request()->routeIs('profil')">Profil</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">Galeri</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">Users</x-responsive-nav-link>
            </div>

            <div class="mt-6 rounded-3xl border border-slate-200 bg-violet-50 p-4">
                <p class="text-sm font-semibold text-slate-950">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                <div class="mt-4 space-y-2">
                    <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
