<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Galeri</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola dokumentasi kegiatan STT Dwi Putra.</p>
            </div>
            @can('manage-kegiatan')
                <a href="{{ route('galeri.create') }}" class="btn-primary">Tambah Galeri</a>
            @endcan
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-[28px] border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel">
        <form class="grid gap-4 md:grid-cols-[1fr_auto]" method="GET" action="{{ route('galeri.index') }}">
            <input type="search" name="search" placeholder="Cari judul galeri..." value="{{ $search }}" class="input-field" />
            <button type="submit" class="btn-primary">Cari</button>
        </form>
    </div>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($galeris as $galeri)
            <div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-panel">
                @if ($galeri->foto)
                    <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="h-44 w-full object-cover" />
                @else
                    <div class="flex h-44 items-center justify-center bg-slate-100 text-sm text-slate-500">Tidak ada foto</div>
                @endif
                <div class="p-6">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="text-lg font-semibold text-slate-950">{{ $galeri->judul }}</h3>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $galeri->deskripsi ?? '-' }}</p>
                    @can('manage-kegiatan')
                        <div class="mt-4 flex gap-3">
                            <a href="{{ route('galeri.edit', $galeri) }}" class="text-sm font-semibold text-[#7C3AED]">Edit</a>
                            <form action="{{ route('galeri.destroy', $galeri) }}" method="POST" onsubmit="return confirm('Hapus galeri ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-semibold text-rose-600">Hapus</button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        @empty
            <div class="md:col-span-2 xl:col-span-3 rounded-[28px] border border-slate-200 bg-white p-10 text-center text-sm text-slate-500">
                Belum ada galeri. Tambahkan galeri baru untuk memulai.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $galeris->links() }}
    </div>
</x-app-layout>
