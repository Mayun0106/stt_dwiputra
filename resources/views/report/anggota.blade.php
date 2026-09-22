<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Laporan Anggota</h2>
                <p class="mt-1 text-sm text-slate-500">Ringkasan data anggota yang terdaftar di STT Dwi Putra.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('report.anggota.pdf') }}" class="btn-primary">Export PDF</a>
                <a href="{{ route('report.anggota.print') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Print</a>
            </div>
        </div>
    </x-slot>

    <div class="mb-6 rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Jumlah Data</p>
                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $count }}</p>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-200 shadow-panel">
        <table class="min-w-full divide-y divide-slate-200 bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Jabatan</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Alamat</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Nomor HP</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach ($anggotas as $index => $anggota)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $anggota->nama }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $anggota->jabatan ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $anggota->alamat ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $anggota->nomor_hp ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-semibold {{ $anggota->status === 'aktif' ? 'text-emerald-600' : 'text-rose-600' }}">{{ ucfirst($anggota->status ?? '-') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
