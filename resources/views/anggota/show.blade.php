<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Detail Anggota</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi lengkap anggota STT Dwi Putra.</p>
            </div>
            <a href="{{ route('anggota.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-[1fr_0.9fr]">
        <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    @if ($anggotum->foto)
                        <img src="{{ asset('storage/' . $anggotum->foto) }}" alt="Foto {{ $anggotum->nama }}" class="h-28 w-28 rounded-3xl object-cover" />
                    @else
                        <div class="flex h-28 w-28 items-center justify-center rounded-3xl bg-slate-100 text-slate-500">No Photo</div>
                    @endif
                    <div>
                        <h3 class="text-2xl font-semibold text-slate-950">{{ $anggotum->nama }}</h3>
                        <p class="text-sm text-slate-500">{{ $anggotum->jabatan ?? 'Tidak ada jabatan' }}</p>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-[#F8F3FF] p-4">
                        <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Email</p>
                        <p class="mt-2 text-sm text-slate-700">{{ $anggotum->email ?? '-' }}</p>
                    </div>
                    <div class="rounded-3xl bg-[#F8F3FF] p-4">
                        <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Status</p>
                        <p class="mt-2 text-sm font-semibold {{ $anggotum->status === 'aktif' ? 'text-emerald-600' : 'text-rose-600' }}">{{ ucfirst($anggotum->status) }}</p>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Nomor HP</p>
                        <p class="mt-2 text-slate-900">{{ $anggotum->nomor_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Tanggal Lahir</p>
                        <p class="mt-2 text-slate-900">{{ optional($anggotum->tanggal_lahir)->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500">Alamat</p>
                    <p class="mt-2 text-slate-900">{{ $anggotum->alamat ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500">Keterangan</p>
                    <p class="mt-2 text-slate-900">{{ $anggotum->keterangan ?? '-' }}</p>
                </div>
            </div>
        </div>
        <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
            <h3 class="text-lg font-semibold text-slate-950">Aksi Cepat</h3>
            <div class="mt-4 space-y-3">
                <a href="{{ route('anggota.edit', $anggotum) }}" class="block rounded-3xl border border-[#7C3AED] bg-[#F8F3FF] px-5 py-3 text-sm font-semibold text-[#7C3AED] transition hover:bg-[#F5EEFF]">Edit Anggota</a>
                <form action="{{ route('anggota.destroy', $anggotum) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-3xl bg-rose-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Hapus Anggota</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
