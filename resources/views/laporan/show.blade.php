<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Detail Laporan</h2>
                <p class="mt-1 text-sm text-slate-500">Lihat isi dan lampiran laporan.</p>
            </div>
            <a href="{{ route('laporan.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Judul</p>
                <h3 class="mt-2 text-2xl font-semibold text-slate-950">{{ $laporan->judul }}</h3>
                <p class="mt-3 text-sm text-slate-600">Tipe: <span class="font-semibold text-slate-900">{{ ucfirst($laporan->tipe) }}</span></p>
            </div>
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Status</p>
                <span class="mt-2 inline-flex rounded-full bg-[#F8F3FF] px-4 py-2 text-sm font-semibold text-slate-900">{{ ucfirst($laporan->status) }}</span>
            </div>
        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2">
            <div class="rounded-3xl bg-[#F8F3FF] p-5">
                <p class="text-sm text-slate-500">Tanggal Laporan</p>
                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ optional($laporan->tanggal_laporan)->format('d M Y') }}</p>
            </div>
            <div class="rounded-3xl bg-[#F8F3FF] p-5">
                <p class="text-sm text-slate-500">Penulis</p>
                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $laporan->user->name ?? 'Unknown' }}</p>
            </div>
        </div>

        <div class="mt-8">
            <p class="text-sm font-semibold text-slate-500">Konten</p>
            <p class="mt-2 text-slate-900">{{ $laporan->konten ?? '-' }}</p>
        </div>

        <div class="mt-6">
            <p class="text-sm font-semibold text-slate-500">Keterangan</p>
            <p class="mt-2 text-slate-900">{{ $laporan->keterangan ?? '-' }}</p>
        </div>

        @if ($laporan->file_path)
            <div class="mt-8 rounded-[28px] border border-slate-200 bg-[#F8F3FF] p-6">
                <p class="text-sm font-semibold text-slate-500">Lampiran File</p>
                <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="font-semibold text-slate-900">{{ basename($laporan->file_path) }}</p>
                    <a href="{{ route('laporan.preview', $laporan) }}" class="rounded-full border border-[#7C3AED] bg-white px-4 py-2 text-sm font-semibold text-[#7C3AED] transition hover:bg-[#F5EEFF]">Download</a>
                </div>
            </div>
        @endif

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('laporan.edit', $laporan) }}" class="rounded-full border border-[#7C3AED] bg-[#F8F3FF] px-6 py-3 text-sm font-semibold text-[#7C3AED] transition hover:bg-[#F5EEFF]">Edit Laporan</a>
            <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus laporan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-full bg-rose-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Hapus Laporan</button>
            </form>
        </div>
    </div>
</x-app-layout>
