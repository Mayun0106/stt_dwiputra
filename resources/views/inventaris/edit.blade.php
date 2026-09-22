<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Edit Inventaris</h2>
                <p class="mt-1 text-sm text-slate-500">Perbarui data inventaris yang sudah ada.</p>
            </div>
            <a href="{{ route('inventaris.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        <form action="{{ route('inventaris.update', ['inventaris' => $inventaris]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-slate-700">Nama Barang</label>
                    <input id="nama_barang" name="nama_barang" type="text" value="{{ old('nama_barang', $inventaris->nama_barang) }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                </div>
                <div>
                    <label for="kategori" class="block text-sm font-medium text-slate-700">Kategori</label>
                    <input id="kategori" name="kategori" type="text" value="{{ old('kategori', $inventaris->kategori) }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                </div>
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-slate-700">Jumlah</label>
                    <input id="jumlah" name="jumlah" type="number" min="0" value="{{ old('jumlah', $inventaris->jumlah) }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                </div>
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-slate-700">Lokasi</label>
                    <input id="lokasi" name="lokasi" type="text" value="{{ old('lokasi', $inventaris->lokasi) }}" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                </div>
                <div>
                    <label for="kondisi" class="block text-sm font-medium text-slate-700">Kondisi</label>
                    <select id="kondisi" name="kondisi" class="input-field mt-2" required>
                        <option value="baik" {{ old('kondisi', $inventaris->kondisi) === 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ old('kondisi', $inventaris->kondisi) === 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="hilang" {{ old('kondisi', $inventaris->kondisi) === 'hilang' ? 'selected' : '' }}>Hilang</option>
                    </select>
                    <x-input-error :messages="$errors->get('kondisi')" class="mt-2" />
                </div>
                <div>
                    <label for="tanggal_input" class="block text-sm font-medium text-slate-700">Tanggal Input</label>
                    <input id="tanggal_input" name="tanggal_input" type="date" value="{{ old('tanggal_input', optional($inventaris->tanggal_input)->format('Y-m-d')) }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('tanggal_input')" class="mt-2" />
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select id="status" name="status" class="input-field mt-2" required>
                        <option value="tersedia" {{ old('status', $inventaris->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="tidak_tersedia" {{ old('status', $inventaris->status) === 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <div>
                <label for="keterangan" class="block text-sm font-medium text-slate-700">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="4" class="input-field mt-2">{{ old('keterangan', $inventaris->keterangan) }}</textarea>
                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium text-slate-700">Foto Barang</label>
                @if ($inventaris->foto)
                    <img src="{{ asset('storage/' . $inventaris->foto) }}" alt="Foto {{ $inventaris->nama_barang }}" class="mt-3 h-32 w-32 rounded-2xl border border-slate-200 object-cover" />
                @endif
                <input id="foto" name="foto" type="file" accept=".jpg,.jpeg,.png" class="input-field mt-3" />
                <p class="mt-1 text-xs text-slate-500">Format JPG atau PNG, maksimal 2 MB.</p>
                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Perbarui Inventaris</button>
            </div>
        </form>
    </div>
</x-app-layout>
