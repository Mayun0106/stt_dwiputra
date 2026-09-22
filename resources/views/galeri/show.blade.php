<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Detail Galeri</h2>
                <p class="mt-1 text-sm text-slate-500">Detail foto dokumentasi kegiatan.</p>
            </div>
            <a href="{{ route('galeri.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        @if ($galeri->foto)
            <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="h-80 w-full rounded-[24px] object-cover" />
        @endif
        <div class="mt-6">
            <h3 class="text-2xl font-semibold text-slate-950">{{ $galeri->judul }}</h3>
            <p class="mt-3 text-slate-600">{{ $galeri->deskripsi ?? '-' }}</p>
        </div>
    </div>
</x-app-layout>
