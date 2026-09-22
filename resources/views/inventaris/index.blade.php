<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Inventaris Barang</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola aset dan barang inventaris STT Dwi Putra.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                @can('manage-inventaris')
                    <a href="{{ route('inventaris.export.excel', request()->query()) }}" class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100">Export Excel</a>
                    <a href="{{ route('inventaris.export.pdf', request()->query()) }}" class="inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-100">Cetak PDF</a>
                    <a href="{{ route('inventaris.create') }}" class="inline-flex items-center gap-2 rounded-full bg-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-violet-700">Tambah Barang</a>
                @endcan
            </div>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-[28px] border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel">
        <form class="grid gap-4 md:grid-cols-[1fr_auto] lg:grid-cols-[1.5fr_1fr_auto]" method="GET" action="{{ route('inventaris.index') }}">
            <input type="search" name="search" placeholder="Cari nama barang atau kode inventaris..." value="{{ $search }}" class="input-field" />
            <select name="kondisi" class="input-field">
                <option value="">Semua Kondisi</option>
                <option value="baik" {{ $kondisi === 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak" {{ $kondisi === 'rusak' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="hilang" {{ $kondisi === 'hilang' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
            <button type="submit" class="btn-primary">Filter</button>
        </form>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-200 shadow-panel" x-data="{
        detailOpen: false,
        detailItem: null,
    }">
        <table class="min-w-full divide-y divide-slate-200 bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Foto</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Kode</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Nama Barang</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Jumlah</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Kondisi</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Lokasi</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($inventaris as $item)
                    @php
                        $kondisiLabel = match ($item->kondisi) {
                            'baik' => 'Baik',
                            'rusak' => 'Rusak Ringan',
                            'hilang' => 'Rusak Berat',
                            default => ucfirst((string) $item->kondisi),
                        };

                        $kondisiClass = match ($item->kondisi) {
                            'baik' => 'bg-emerald-100 text-emerald-700',
                            'rusak' => 'bg-yellow-100 text-yellow-700',
                            'hilang' => 'bg-red-100 text-red-700',
                            default => 'bg-slate-100 text-slate-700',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-xs font-bold text-violet-700">
                                {{ strtoupper(substr($item->nama_barang, 0, 2)) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $item->kode_barang ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $item->nama_barang }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->jumlah }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $kondisiClass }}">{{ $kondisiLabel }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->lokasi ?? '-' }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                    x-on:click="detailOpen = true; detailItem = {
                                        kode: @js($item->kode_barang ?? '-'),
                                        nama: @js($item->nama_barang),
                                        foto: @js($item->foto ? asset('storage/' . $item->foto) : null),
                                        kategori: @js($item->kategori ?? '-'),
                                        jumlah: @js($item->jumlah),
                                        kondisi: @js($kondisiLabel),
                                        lokasi: @js($item->lokasi ?? '-'),
                                        status: @js(ucfirst($item->status ?? '-')),
                                        tanggal_input: @js($item->tanggal_input ? $item->tanggal_input->format('d/m/Y') : '-'),
                                        keterangan: @js($item->keterangan ?? '-')
                                    };"
                                    class="inline-flex items-center gap-1 rounded-md bg-blue-600 px-2.5 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.218 7.37 4 12 4s8.577 3.218 9.964 7.678a1.012 1.012 0 010 .644C20.577 16.782 16.63 20 12 20s-8.577-3.218-9.964-7.678z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    Detail
                                </button>

                                @can('manage-inventaris')
                                    <a href="{{ route('inventaris.edit', ['inventaris' => $item]) }}" class="inline-flex items-center gap-1 rounded-md bg-amber-500 px-2.5 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('inventaris.destroy', ['inventaris' => $item]) }}" method="POST" onsubmit="return confirm('Hapus barang inventaris ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 rounded-md bg-red-600 px-2.5 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada inventaris. Tambahkan barang baru untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div x-show="detailOpen" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 p-4" style="display: none;">
            <div @click.outside="detailOpen = false" class="w-full max-w-2xl rounded-[28px] bg-white p-6 shadow-2xl">
                <div class="mb-5 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900">Detail Barang</h3>
                    <button type="button" x-on:click="detailOpen = false" class="rounded-full border border-slate-200 px-3 py-1.5 text-sm text-slate-600 hover:bg-slate-100">Tutup</button>
                </div>

                <div x-show="detailItem" class="space-y-5" style="display: none;">
                    <div class="flex items-center justify-between rounded-2xl border border-violet-200 bg-violet-50 p-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-violet-500">Kode Barang</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900" x-text="detailItem?.kode ?? '-'"></p>
                        </div>
                        <template x-if="detailItem?.foto">
                            <img :src="detailItem.foto" :alt="'Foto ' + (detailItem?.nama || 'barang')" class="h-16 w-16 rounded-2xl border border-slate-200 object-cover" />
                        </template>
                        <template x-if="!detailItem?.foto">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-violet-100 text-sm font-bold text-violet-700" x-text="(detailItem?.nama || '').slice(0, 2).toUpperCase()"></div>
                        </template>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Nama Barang</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailItem?.nama ?? '-'"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Kategori</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailItem?.kategori ?? '-'"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Jumlah</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailItem?.jumlah ?? '-'"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Kondisi</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailItem?.kondisi ?? '-'"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Lokasi</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailItem?.lokasi ?? '-'"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Status Peminjaman</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailItem?.status ?? '-'"></p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Tanggal Input</p>
                        <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailItem?.tanggal_input ?? '-'"></p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Keterangan</p>
                        <p class="mt-2 text-sm text-slate-700" x-text="detailItem?.keterangan ?? '-'"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        {{ $inventaris->links() }}
    </div>
</x-app-layout>
