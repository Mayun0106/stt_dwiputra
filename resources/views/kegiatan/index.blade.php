<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Kegiatan</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola jadwal kegiatan dan status event.</p>
            </div>
            @can('manage-kegiatan')
                <a href="{{ route('kegiatan.create') }}" class="btn-primary">Tambah Kegiatan</a>
            @endcan
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-[28px] border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel">
        <form class="grid gap-4 md:grid-cols-[1fr_auto] lg:grid-cols-[1.5fr_1fr_auto]" method="GET" action="{{ route('kegiatan.index') }}">
            <input type="search" name="search" placeholder="Cari nama kegiatan..." value="{{ $search }}" class="input-field" />
            <select name="status" class="input-field">
                <option value="">Semua status</option>
                <option value="upcoming" {{ $status === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                <option value="berlangsung" {{ $status === 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit" class="btn-primary">Filter</button>
        </form>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-200 shadow-panel">
        <table class="min-w-full divide-y divide-slate-200 bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Tanggal Mulai</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Lokasi</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($kegiatans as $kegiatan)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $kegiatan->nama }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $kegiatan->tanggal_mulai->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $kegiatan->lokasi ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-semibold {{ $kegiatan->status === 'selesai' ? 'text-slate-500' : ($kegiatan->status === 'berlangsung' ? 'text-amber-600' : 'text-sky-600') }}">{{ ucfirst($kegiatan->status) }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            @can('manage-kegiatan')
                                <a href="{{ route('kegiatan.edit', $kegiatan) }}" class="mr-2 text-[#7C3AED] hover:text-[#5b21b6]">Edit</a>
                                <form action="{{ route('kegiatan.destroy', $kegiatan) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus kegiatan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>Hapus</x-danger-button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada kegiatan. Tambahkan kegiatan baru untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $kegiatans->links() }}
    </div>
</x-app-layout>
