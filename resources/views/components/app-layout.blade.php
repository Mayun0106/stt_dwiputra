<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#F8FAFC] text-slate-900 antialiased">
        <div class="flex min-h-screen">
            <aside class="hidden w-80 shrink-0 flex-col border-r border-slate-200 bg-white px-6 py-6 lg:flex">
                <nav class="mt-2 space-y-1 text-sm font-medium text-slate-700">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-slate-900 shadow-sm shadow-[#7C3AED]/5 transition hover:bg-[#F8F3FF] {{ request()->routeIs('dashboard') ? 'bg-[#F5EEFF] text-[#6D28D9]' : '' }}">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#EEF2FF] text-[#7C3AED]">D</span>
                        Dashboard
                    </a>
                    <a href="{{ route('anggota.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 transition hover:bg-[#F8F3FF] {{ request()->routeIs('anggota.*') ? 'bg-[#F5EEFF] text-[#6D28D9]' : '' }}">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#E9D5FF] text-[#7C3AED]">A</span>
                        Anggota
                    </a>
                    <a href="{{ route('inventaris.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 transition hover:bg-[#F8F3FF] {{ request()->routeIs('inventaris.*') ? 'bg-[#F5EEFF] text-[#6D28D9]' : '' }}">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#E9D5FF] text-[#7C3AED]">I</span>
                        Inventaris
                    </a>
                    <a href="{{ route('kegiatan.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 transition hover:bg-[#F8F3FF] {{ request()->routeIs('kegiatan.*') ? 'bg-[#F5EEFF] text-[#6D28D9]' : '' }}">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#E9D5FF] text-[#7C3AED]">K</span>
                        Kegiatan
                    </a>
                    <a href="{{ route('report.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 transition hover:bg-[#F8F3FF] {{ request()->routeIs('report.*') ? 'bg-[#F5EEFF] text-[#6D28D9]' : '' }}">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#E9D5FF] text-[#7C3AED]">L</span>
                        Laporan
                    </a>
                    <a href="{{ route('users.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 transition hover:bg-[#F8F3FF] {{ request()->routeIs('users.*') ? 'bg-[#F5EEFF] text-[#6D28D9]' : '' }}">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#E9D5FF] text-[#7C3AED]">U</span>
                        Users
                    </a>
                </nav>

                <div class="mt-auto rounded-[28px] border border-slate-200 bg-[#F8F3FF] p-4 text-sm text-slate-700">
                    <p class="font-semibold text-slate-950">Akun</p>
                    <p class="mt-2">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('profile.edit') }}" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700">Logout</button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="flex-1">
                @if (isset($header))
                    <header class="border-b border-slate-200 bg-white/95 backdrop-blur">
                        <div class="mx-auto flex min-h-[72px] max-w-[1800px] flex-col gap-4 px-4 py-4 sm:px-6 lg:px-8 xl:px-10 lg:flex-row lg:items-center lg:justify-between">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="px-4 py-8 sm:px-6 lg:px-8">
                    <div class="mx-auto w-full max-w-[1800px]">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
