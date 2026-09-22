<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Detail Kegiatan</h2>
                <p class="mt-1 text-sm text-slate-500">Lihat informasi acara dan jadwal kegiatan.</p>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Nama Kegiatan</p>
                <h3 class="mt-2 text-2xl font-semibold text-slate-950">{{ $kegiatan->nama }}</h3>
                <p class="mt-3 text-sm text-slate-600">Lokasi: <span class="font-semibold text-slate-900">{{ $kegiatan->lokasi ?? '-' }}</span></p>
            </div>
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Status</p>
                <span class="mt-2 inline-flex rounded-full bg-[#F8F3FF] px-4 py-2 text-sm font-semibold text-slate-900">{{ ucfirst($kegiatan->status) }}</span>
            </div>
        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2">
            <div class="rounded-3xl bg-[#F8F3FF] p-5">
                <p class="text-sm text-slate-500">Tanggal Mulai</p>
                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ optional($kegiatan->tanggal_mulai)->format('d M Y') }}</p>
            </div>
            <div class="rounded-3xl bg-[#F8F3FF] p-5">
                <p class="text-sm text-slate-500">Tanggal Selesai</p>
                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ optional($kegiatan->tanggal_selesai)->format('d M Y') ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-8">
            <p class="text-sm font-semibold text-slate-500">Deskripsi</p>
            <p class="mt-2 text-slate-900">{{ $kegiatan->deskripsi ?? '-' }}</p>
        </div>

        <div class="mt-6">
            <p class="text-sm font-semibold text-slate-500">Keterangan</p>
            <p class="mt-2 text-slate-900">{{ $kegiatan->keterangan ?? '-' }}</p>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('kegiatan.edit', $kegiatan) }}" class="rounded-full border border-[#7C3AED] bg-[#F8F3FF] px-6 py-3 text-sm font-semibold text-[#7C3AED] transition hover:bg-[#F5EEFF]">Edit Kegiatan</a>
            <form action="{{ route('kegiatan.destroy', $kegiatan) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus kegiatan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-full bg-rose-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Hapus Kegiatan</button>
            </form>
        </div>
    </div>
</x-app-layout>
