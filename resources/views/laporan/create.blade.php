<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Tambah Laporan</h2>
                <p class="mt-1 text-sm text-slate-500">Buat laporan baru dengan opsi upload file.</p>
            </div>
            <a href="{{ route('laporan.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label for="judul" class="block text-sm font-medium text-slate-700">Judul</label>
                    <input id="judul" name="judul" type="text" value="{{ old('judul') }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                </div>
                <div>
                    <label for="tipe" class="block text-sm font-medium text-slate-700">Tipe Laporan</label>
                    <select id="tipe" name="tipe" class="input-field mt-2" required>
                        <option value="anggota" {{ old('tipe') === 'anggota' ? 'selected' : '' }}>Anggota</option>
                        <option value="inventaris" {{ old('tipe') === 'inventaris' ? 'selected' : '' }}>Inventaris</option>
                        <option value="kegiatan" {{ old('tipe') === 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    </select>
                    <x-input-error :messages="$errors->get('tipe')" class="mt-2" />
                </div>
                <div>
                    <label for="tanggal_laporan" class="block text-sm font-medium text-slate-700">Tanggal Laporan</label>
                    <input id="tanggal_laporan" name="tanggal_laporan" type="date" value="{{ old('tanggal_laporan') }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('tanggal_laporan')" class="mt-2" />
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select id="status" name="status" class="input-field mt-2" required>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <div>
                <label for="konten" class="block text-sm font-medium text-slate-700">Konten</label>
                <textarea id="konten" name="konten" rows="4" class="input-field mt-2">{{ old('konten') }}</textarea>
                <x-input-error :messages="$errors->get('konten')" class="mt-2" />
            </div>

            <div>
                <label for="file_path" class="block text-sm font-medium text-slate-700">File Lampiran</label>
                <input id="file_path" name="file_path" type="file" class="mt-2" />
                <x-input-error :messages="$errors->get('file_path')" class="mt-2" />
            </div>

            <div>
                <label for="keterangan" class="block text-sm font-medium text-slate-700">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="4" class="input-field mt-2">{{ old('keterangan') }}</textarea>
                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Simpan Laporan</button>
            </div>
        </form>
    </div>
</x-app-layout>
