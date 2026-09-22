<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Anggota</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola daftar anggota STT Dwi Putra.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                @can('manage-anggota')
                    <a href="{{ route('anggota.export.excel', request()->query()) }}" class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100">Export Excel</a>
                    <a href="{{ route('anggota.export.pdf', request()->query()) }}" class="inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-100">Cetak PDF</a>
                    <a href="{{ route('anggota.create') }}" class="btn-primary">Tambah Anggota</a>
                @endcan
            </div>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-[28px] border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel" x-data>
        <form class="grid gap-4 md:grid-cols-[1fr_auto] lg:grid-cols-[1.5fr_1fr_auto]" method="GET" action="{{ route('anggota.index') }}">
            <input type="search" name="search" placeholder="Cari nama anggota..." value="{{ $search }}" class="input-field" />
            <select name="status" class="input-field">
                <option value="">Semua status</option>
                <option value="aktif" {{ $status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <button type="submit" class="btn-primary">Filter</button>
        </form>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-200 shadow-panel" x-data="{
        detailOpen: false,
        detailAnggota: null,
    }">
        <table class="min-w-full divide-y divide-slate-200 bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Foto</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Jabatan</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($anggotas as $anggota)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($anggota->foto)
                                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="h-12 w-12 rounded-3xl object-cover" />
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($anggota->nama) }}&background=random&color=fff&size=96" alt="Avatar {{ $anggota->nama }}" class="h-12 w-12 rounded-3xl object-cover" />
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $anggota->nama }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $anggota->jabatan ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $anggota->email ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-semibold {{ $anggota->status === 'aktif' ? 'text-emerald-600' : 'text-rose-600' }}">{{ ucfirst($anggota->status) }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                    x-on:click="detailOpen = true; detailAnggota = {
                                        foto: @js($anggota->foto ? asset('storage/' . $anggota->foto) : ''),
                                        nama: @js($anggota->nama),
                                        jabatan: @js($anggota->jabatan ?? '-'),
                                        email: @js($anggota->email ?? '-'),
                                        nomor_hp: @js($anggota->nomor_hp ?? '-'),
                                        alamat: @js($anggota->alamat ?? '-'),
                                        tanggal_lahir: @js($anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d/m/Y') : '-'),
                                        status: @js(ucfirst($anggota->status ?? '-')),
                                        keterangan: @js($anggota->keterangan ?? '-')
                                    };"
                                    class="inline-flex items-center gap-1 rounded-md bg-blue-600 px-2.5 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.218 7.37 4 12 4s8.577 3.218 9.964 7.678a1.012 1.012 0 010 .644C20.577 16.782 16.63 20 12 20s-8.577-3.218-9.964-7.678z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    Detail
                                </button>

                                @can('manage-anggota')
                                    <a href="{{ route('anggota.edit', $anggota) }}" class="inline-flex items-center gap-1 rounded-md bg-amber-500 px-2.5 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('anggota.destroy', $anggota) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?');">
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
                        <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada anggota. Tambahkan anggota baru untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div x-show="detailOpen" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 p-4" style="display: none;">
            <div @click.outside="detailOpen = false" class="w-full max-w-2xl rounded-[28px] bg-white p-6 shadow-2xl">
                <div class="mb-5 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900">Detail Anggota</h3>
                    <button type="button" x-on:click="detailOpen = false" class="rounded-full border border-slate-200 px-3 py-1.5 text-sm text-slate-600 hover:bg-slate-100">Tutup</button>
                </div>

                <div x-show="detailAnggota" class="space-y-5">
                    <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-start">
                        <img :src="detailAnggota?.foto || ''" :alt="detailAnggota?.nama || 'Foto anggota'" class="h-28 w-28 rounded-3xl object-cover border border-slate-200 bg-slate-100" x-show="detailAnggota?.foto" style="display: none;" />
                        <div x-show="!detailAnggota?.foto" class="flex h-28 w-28 items-center justify-center rounded-3xl border border-dashed border-slate-200 bg-slate-100 text-sm text-slate-500" style="display: none;">No Photo</div>
                        <div class="w-full space-y-2">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Nama Lengkap</p>
                                <p class="mt-1 text-lg font-semibold text-slate-900" x-text="detailAnggota?.nama ?? '-'"></p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Status</p>
                                <span class="mt-1 inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700" x-text="detailAnggota?.status ?? '-'" x-show="(detailAnggota?.status || '').toLowerCase() === 'aktif'" style="display: none;"></span>
                                <span class="mt-1 inline-flex rounded-full bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700" x-text="detailAnggota?.status ?? '-'" x-show="(detailAnggota?.status || '').toLowerCase() === 'nonaktif'" style="display: none;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Jabatan</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailAnggota?.jabatan ?? '-'"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Email</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailAnggota?.email ?? '-'"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Nomor HP / WhatsApp</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailAnggota?.nomor_hp ?? '-'"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Tanggal Lahir</p>
                            <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailAnggota?.tanggal_lahir ?? '-'"></p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Alamat / Banjar</p>
                        <p class="mt-2 text-sm font-medium text-slate-800" x-text="detailAnggota?.alamat ?? '-'"></p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Keterangan</p>
                        <p class="mt-2 text-sm text-slate-700" x-text="detailAnggota?.keterangan ?? '-'"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        {{ $anggotas->links() }}
    </div>
</x-app-layout>
