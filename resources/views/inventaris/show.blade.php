<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Detail Inventaris</h2>
                <p class="mt-1 text-sm text-slate-500">Lihat informasi lengkap barang inventaris.</p>
            </div>
            <a href="{{ route('inventaris.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Nama Barang</p>
                <h3 class="mt-2 text-2xl font-semibold text-slate-950">{{ $inventaris->nama_barang }}</h3>
                <p class="mt-3 text-sm text-slate-600">Kategori: <span class="font-semibold text-slate-900">{{ $inventaris->kategori }}</span></p>
            </div>
            <div class="flex items-start gap-4">
                @if ($inventaris->foto)
                    <img src="{{ asset('storage/' . $inventaris->foto) }}" alt="Foto {{ $inventaris->nama_barang }}" class="h-24 w-24 rounded-2xl border border-slate-200 object-cover" />
                @else
                    <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-violet-100 text-2xl font-bold text-violet-700">
                        {{ strtoupper(substr($inventaris->nama_barang, 0, 2)) }}
                    </div>
                @endif
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Status</p>
                    <span class="mt-2 inline-flex rounded-full bg-[#F8F3FF] px-4 py-2 text-sm font-semibold text-slate-900">{{ ucfirst($inventaris->status) }}</span>
                </div>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl bg-[#F8F3FF] p-5">
                <p class="text-sm text-slate-500">Jumlah</p>
                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $inventaris->jumlah }}</p>
            </div>
            <div class="rounded-3xl bg-[#F8F3FF] p-5">
                <p class="text-sm text-slate-500">Kondisi</p>
                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ ucfirst($inventaris->kondisi) }}</p>
            </div>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <div>
                <p class="text-sm font-semibold text-slate-500">Lokasi</p>
                <p class="mt-2 text-slate-900">{{ $inventaris->lokasi ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500">Tanggal Input</p>
                <p class="mt-2 text-slate-900">{{ optional($inventaris->tanggal_input)->format('d M Y') }}</p>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-sm font-semibold text-slate-500">Keterangan</p>
            <p class="mt-2 text-slate-900">{{ $inventaris->keterangan ?? '-' }}</p>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('inventaris.edit', ['inventaris' => $inventaris]) }}" class="rounded-full border border-[#7C3AED] bg-[#F8F3FF] px-6 py-3 text-sm font-semibold text-[#7C3AED] transition hover:bg-[#F5EEFF]">Edit Inventaris</a>
            <form action="{{ route('inventaris.destroy', ['inventaris' => $inventaris]) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus inventaris ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-full bg-rose-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Hapus Inventaris</button>
            </form>
        </div>
    </div>
</x-app-layout>
