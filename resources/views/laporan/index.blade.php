<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Laporan</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola laporan, status, dan file pelaporan.</p>
            </div>
            @can('manage-laporan')
                <a href="{{ route('laporan.create') }}" class="btn-primary">Tambah Laporan</a>
            @endcan
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-[28px] border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel">
        <form class="grid gap-4 md:grid-cols-[1fr_auto] lg:grid-cols-[1.5fr_1fr_auto]" method="GET" action="{{ route('laporan.index') }}">
            <input type="search" name="search" placeholder="Cari judul laporan..." value="{{ $search }}" class="input-field" />
            <select name="tipe" class="input-field">
                <option value="">Semua tipe</option>
                <option value="anggota" {{ $tipe === 'anggota' ? 'selected' : '' }}>Anggota</option>
                <option value="inventaris" {{ $tipe === 'inventaris' ? 'selected' : '' }}>Inventaris</option>
                <option value="kegiatan" {{ $tipe === 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
            </select>
            <button type="submit" class="btn-primary">Filter</button>
        </form>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-200 shadow-panel">
        <table class="min-w-full divide-y divide-slate-200 bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Judul</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Tipe</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($laporans as $laporan)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $laporan->judul }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ ucfirst($laporan->tipe) }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $laporan->tanggal_laporan->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm font-semibold {{ $laporan->status === 'published' ? 'text-emerald-600' : ($laporan->status === 'draft' ? 'text-slate-500' : 'text-amber-600') }}">{{ ucfirst($laporan->status) }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('laporan.preview', $laporan) }}" class="mr-2 text-[#7C3AED] hover:text-[#5b21b6]">Preview</a>
                            @can('manage-laporan')
                                <a href="{{ route('laporan.edit', $laporan) }}" class="mr-2 text-[#7C3AED] hover:text-[#5b21b6]">Edit</a>
                                <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>Hapus</x-danger-button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada laporan. Tambahkan laporan baru untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $laporans->links() }}
    </div>
</x-app-layout>
