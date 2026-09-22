<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Profil STT Dwi Putra</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi singkat tentang organisasi kami dan fokus kegiatan.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Tentang Kami</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-950">Komunitas yang bergerak di bidang pendidikan, teknologi, dan pengabdian.</h3>
            <p class="mt-4 text-sm leading-7 text-slate-600">STT Dwi Putra memfokuskan diri pada pengembangan kapasitas anggota melalui kegiatan rutin, pelatihan, pengelolaan inventaris, dan dokumentasi program. Sistem ini hadir untuk membantu seluruh pengurus mengelola informasi secara lebih rapi dan akuntabel.</p>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-[24px] bg-[#F8F3FF] p-4">
                    <p class="text-sm text-slate-500">Visi</p>
                    <p class="mt-2 font-semibold text-slate-900">Menjadi komunitas yang terorganisir, inovatif, dan bermanfaat.</p>
                </div>
                <div class="rounded-[24px] bg-[#F8F3FF] p-4">
                    <p class="text-sm text-slate-500">Misi</p>
                    <p class="mt-2 font-semibold text-slate-900">Meningkatkan kualitas program, kerja tim, dan pelayanan bagi anggota.</p>
                </div>
            </div>
        </div>

        <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Poin Unggulan</p>
            <ul class="mt-5 space-y-4 text-sm text-slate-600">
                <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-2xl bg-[#EEF2FF] text-[#4338CA]">✓</span> Pengelolaan anggota dan jabatan yang terstruktur.</li>
                <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-2xl bg-[#EEF2FF] text-[#4338CA]">✓</span> Inventaris dan kegiatan terintegrasi dalam satu sistem.</li>
                <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-2xl bg-[#EEF2FF] text-[#4338CA]">✓</span> Dokumen laporan dan arsip yang mudah diakses kembali.</li>
            </ul>
        </div>
    </div>
</x-app-layout>
