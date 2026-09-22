<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Laporan</h2>
                <p class="mt-1 text-sm text-slate-500">Lihat ringkasan dan akses laporan anggota, inventaris, dan kegiatan.</p>
            </div>
        </div>
    </x-slot>

    <div class="grid gap-6 xl:grid-cols-3">
        <a href="{{ route('report.anggota') }}" class="group rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel transition hover:border-[#7C3AED] hover:shadow-lg">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Laporan Anggota</p>
                    <h3 class="mt-4 text-3xl font-semibold text-slate-950">{{ $anggotaCount }}</h3>
                    <p class="mt-2 text-sm text-slate-500">Total anggota yang tersimpan di sistem.</p>
                </div>
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#7C3AED] text-lg font-semibold">A</span>
            </div>
        </a>

        <a href="{{ route('report.inventaris') }}" class="group rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel transition hover:border-[#7C3AED] hover:shadow-lg">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Laporan Inventaris</p>
                    <h3 class="mt-4 text-3xl font-semibold text-slate-950">{{ $inventarisCount }}</h3>
                    <p class="mt-2 text-sm text-slate-500">Data barang dan kondisi inventaris.</p>
                </div>
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#7C3AED] text-lg font-semibold">I</span>
            </div>
        </a>

        <a href="{{ route('report.kegiatan') }}" class="group rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel transition hover:border-[#7C3AED] hover:shadow-lg">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Laporan Kegiatan</p>
                    <h3 class="mt-4 text-3xl font-semibold text-slate-950">{{ $kegiatanCount }}</h3>
                    <p class="mt-2 text-sm text-slate-500">Rekap semua kegiatan yang tercatat.</p>
                </div>
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#7C3AED] text-lg font-semibold">K</span>
            </div>
        </a>
    </div>
</x-app-layout>
