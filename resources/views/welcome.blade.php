<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F8FAFC] text-slate-900 antialiased">
        <div class="mx-auto min-h-screen w-full max-w-[1800px] px-4 py-8 sm:px-6 lg:px-8 xl:px-10">
            <header class="mb-10 flex flex-col gap-4 rounded-[32px] border border-slate-200 bg-white px-6 py-4 shadow-panel sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/dwi-putra.png') }}" alt="STT Dwi Putra" class="h-10 w-10 rounded-2xl border border-slate-200 bg-white object-contain p-1 shadow-sm" />
                    <div class="flex flex-col justify-center leading-none">
                        <p class="whitespace-nowrap text-[16px] font-bold text-slate-950">STT Dwi Putra</p>
                        <p class="mt-1 whitespace-nowrap text-[11px] font-normal text-slate-500">Sistem Informasi</p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center justify-end gap-3">
                    <a href="{{ route('login') }}" class="rounded-full border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-900 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary px-5 py-2.5 text-sm">Register</a>
                </div>
            </header>

            <section class="grid gap-10 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 rounded-full border border-[#E9D5FF] bg-[#F8F3FF] px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">
                        Solusi manajemen anggota, inventaris, kegiatan, dan laporan
                    </div>
                    <div class="max-w-[650px] space-y-4" style="animation: fadeUp 600ms ease-out both;">
                        <h1 class="font-['Plus_Jakarta_Sans'] text-[38px] font-extrabold leading-[1.05] tracking-[-0.02em] text-slate-950 sm:text-[52px] lg:text-[64px]">
                            <span class="block">Sistem Informasi</span>
                            <span class="block">Manajemen</span>
                            <span class="mt-2 block bg-gradient-to-r from-[#7C3AED] via-[#8B5CF6] to-[#A855F7] bg-clip-text text-transparent" style="-webkit-background-clip: text;">
                                STT Dwi Putra
                            </span>
                            <span class="mt-3 block h-2 w-[220px] rounded-full bg-[rgba(124,58,237,0.18)]"></span>
                        </h1>
                        <p class="max-w-[520px] font-['Poppins'] text-[22px] leading-[1.8] text-slate-500">
                            Kelola anggota, inventaris, dan kegiatan dengan lebih mudah, terstruktur, dan efisien dalam satu platform profesional.
                        </p>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -right-16 top-10 h-44 w-44 rounded-full bg-[#E9D5FF] blur-3xl"></div>
                    <div class="absolute left-0 bottom-0 h-28 w-28 rounded-full bg-[#C4B5FD] blur-3xl"></div>
                    <div class="relative flex min-h-[280px] items-center justify-center rounded-3xl bg-white p-6 shadow-2xl sm:min-h-[360px] sm:p-8">
                        <img src="{{ asset('images/dwi-putra.png') }}" alt="STT Dwi Putra Logo" class="h-auto w-full max-w-[420px] object-contain" />
                    </div>
                </div>
            </section>

            <section id="fitur" class="mt-16 rounded-[32px] bg-white p-8 shadow-panel border border-slate-200">
                <div class="mb-10 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Fitur Utama</p>
                        <h2 class="mt-3 text-3xl font-semibold text-slate-950">Solusi lengkap untuk manajemen organisasi</h2>
                    </div>
                </div>
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-[32px] border border-slate-200 bg-[#F8F3FF] p-6 shadow-sm transition hover:shadow-md">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#4338CA]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M5 3h14a2 2 0 012 2v2H3V5a2 2 0 012-2zm-2 6h18v8a2 2 0 01-2 2H5a2 2 0 01-2-2V9zm4 2v4h2v-4H7zm4 0v4h2v-4h-2z"/></svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-slate-900">Manajemen Anggota</h3>
                        <p class="text-sm leading-6 text-slate-600">Kelola data anggota, jabatan, dan status dengan tampilan yang rapi.</p>
                    </div>
                    <div class="rounded-[32px] border border-slate-200 bg-[#F8F3FF] p-6 shadow-sm transition hover:shadow-md">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#4338CA]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v2H4V6zm0 4h16v2H4v-2zm0 4h10v2H4v-2z"/></svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-slate-900">Manajemen Inventaris</h3>
                        <p class="text-sm leading-6 text-slate-600">Catat kondisi, lokasi, dan jumlah inventaris dengan mudah.</p>
                    </div>
                    <div class="rounded-[32px] border border-slate-200 bg-[#F8F3FF] p-6 shadow-sm transition hover:shadow-md">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#4338CA]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M6 2h12v2H6V2zm0 4h12v2H6V6zm0 4h12v2H6v-2zm0 4h12v2H6v-2zm0 4h12v2H6v-2z"/></svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-slate-900">Agenda Kegiatan</h3>
                        <p class="text-sm leading-6 text-slate-600">Atur jadwal, lokasi, dan status kegiatan organisasi.</p>
                    </div>
                    <div class="rounded-[32px] border border-slate-200 bg-[#F8F3FF] p-6 shadow-sm transition hover:shadow-md">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#4338CA]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h16v2H4V4zm0 4h16v2H4V8zm0 4h16v2H4v-2zm0 4h16v2H4v-2z"/></svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-slate-900">Laporan</h3>
                        <p class="text-sm leading-6 text-slate-600">Buat laporan terstruktur dan simpan file dengan mudah.</p>
                    </div>
                </div>
            </section>

            <section class="mt-16 grid gap-6 md:grid-cols-3">
                <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Anggota</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-950">{{ $anggotaCount }}</p>
                    <p class="mt-2 text-sm text-slate-500">Anggota terdaftar di database.</p>
                </div>
                <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Inventaris</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-950">{{ $inventarisCount }}</p>
                    <p class="mt-2 text-sm text-slate-500">Item inventaris aktif.</p>
                </div>
                <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Kegiatan</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-950">{{ $kegiatanCount }}</p>
                    <p class="mt-2 text-sm text-slate-500">Total kegiatan terjadwal.</p>
                </div>
            </section>

            <section class="mt-16 rounded-[32px] bg-white p-8 shadow-panel border border-slate-200">
                <div class="grid gap-6 lg:grid-cols-[1.3fr_0.9fr] lg:items-center">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Keunggulan Sistem</p>
                        <h2 class="mt-3 text-3xl font-semibold text-slate-950">Manajemen organisasi lebih sederhana dan profesional.</h2>
                        <ul class="mt-6 space-y-4 text-sm text-slate-600">
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-[#EEF2FF] text-[#4338CA]">✓</span>
                                Akses cepat dari desktop, tablet, dan mobile.
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-[#EEF2FF] text-[#4338CA]">✓</span>
                                Dashboard intuitif dengan ringkasan data.
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-[#EEF2FF] text-[#4338CA]">✓</span>
                                Laporan dan inventaris terkelola dalam satu platform.
                            </li>
                        </ul>
                    </div>
                    <div class="rounded-[32px] border border-slate-200 bg-[#F8F3FF] p-6">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[28px] bg-white p-5 shadow-sm">
                                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Anggota</p>
                                <p class="mt-4 text-3xl font-semibold text-slate-950">{{ $anggotaCount }}</p>
                            </div>
                            <div class="rounded-[28px] bg-white p-5 shadow-sm">
                                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Inventaris</p>
                                <p class="mt-4 text-3xl font-semibold text-slate-950">{{ $inventarisCount }}</p>
                            </div>
                            <div class="rounded-[28px] bg-white p-5 shadow-sm">
                                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Kegiatan</p>
                                <p class="mt-4 text-3xl font-semibold text-slate-950">{{ $kegiatanCount }}</p>
                            </div>
                            <div class="rounded-[28px] bg-white p-5 shadow-sm">
                                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Users</p>
                                <p class="mt-4 text-3xl font-semibold text-slate-950">{{ $userCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="mt-16 text-center text-sm text-slate-500">
                <p>© 2026 STT Dwi Putra. All rights reserved.</p>
            </footer>
        </div>
    </body>
</html>
