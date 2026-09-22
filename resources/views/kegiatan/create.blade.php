<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Tambah Kegiatan</h2>
                <p class="mt-1 text-sm text-slate-500">Buat jadwal kegiatan baru untuk organisasi Anda.</p>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        <form action="{{ route('kegiatan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label for="nama" class="block text-sm font-medium text-slate-700">Nama Kegiatan</label>
                    <input id="nama" name="nama" type="text" value="{{ old('nama') }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>
                <div>
                    <label for="tanggal_mulai" class="block text-sm font-medium text-slate-700">Tanggal Mulai</label>
                    <input id="tanggal_mulai" name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai') }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
                </div>
                <div>
                    <label for="tanggal_selesai" class="block text-sm font-medium text-slate-700">Tanggal Selesai</label>
                    <input id="tanggal_selesai" name="tanggal_selesai" type="date" value="{{ old('tanggal_selesai') }}" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-2" />
                </div>
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-slate-700">Lokasi</label>
                    <input id="lokasi" name="lokasi" type="text" value="{{ old('lokasi') }}" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select id="status" name="status" class="input-field mt-2" required>
                        <option value="upcoming" {{ old('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="berlangsung" {{ old('status') === 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="selesai" {{ old('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="input-field mt-2">{{ old('deskripsi') }}</textarea>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>

            <div>
                <label for="keterangan" class="block text-sm font-medium text-slate-700">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="4" class="input-field mt-2">{{ old('keterangan') }}</textarea>
                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Simpan Kegiatan</button>
            </div>
        </form>
    </div>
</x-app-layout>
