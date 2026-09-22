<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Edit Galeri</h2>
                <p class="mt-1 text-sm text-slate-500">Perbarui foto dokumentasi kegiatan.</p>
            </div>
            <a href="{{ route('galeri.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        <form action="{{ route('galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="judul" class="block text-sm font-medium text-slate-700">Judul</label>
                <input id="judul" name="judul" type="text" value="{{ old('judul', $galeri->judul) }}" class="input-field mt-2" required />
                <x-input-error :messages="$errors->get('judul')" class="mt-2" />
            </div>
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="input-field mt-2">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>
            <div>
                <label for="foto" class="block text-sm font-medium text-slate-700">Foto</label>
                <input id="foto" name="foto" type="file" accept="image/*" class="mt-2" />
                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Perbarui Galeri</button>
            </div>
        </form>
    </div>
</x-app-layout>
