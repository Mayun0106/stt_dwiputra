<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Edit Anggota</h2>
                <p class="mt-1 text-sm text-slate-500">Perbarui data anggota yang sudah ada.</p>
            </div>
            <a href="{{ route('anggota.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
        <form action="{{ route('anggota.update', $anggotum) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label for="nama" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text" value="{{ old('nama', $anggotum->nama) }}" class="input-field mt-2" required />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $anggotum->email) }}" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <label for="nomor_hp" class="block text-sm font-medium text-slate-700">Nomor HP</label>
                    <input id="nomor_hp" name="nomor_hp" type="text" value="{{ old('nomor_hp', $anggotum->nomor_hp) }}" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('nomor_hp')" class="mt-2" />
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700">Tanggal Lahir</label>
                    <input id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir', optional($anggotum->tanggal_lahir)->format('Y-m-d')) }}" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                </div>
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-slate-700">Jabatan</label>
                    <input id="jabatan" name="jabatan" type="text" value="{{ old('jabatan', $anggotum->jabatan) }}" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select id="status" name="status" class="input-field mt-2" required>
                        <option value="aktif" {{ old('status', $anggotum->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $anggotum->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-slate-700">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" class="input-field mt-2">{{ old('alamat', $anggotum->alamat) }}</textarea>
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>

            <div>
                <label for="keterangan" class="block text-sm font-medium text-slate-700">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="3" class="input-field mt-2">{{ old('keterangan', $anggotum->keterangan) }}</textarea>
                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label for="foto" class="block text-sm font-medium text-slate-700">Foto Profil</label>
                    <input id="foto" name="foto" type="file" accept="image/*" class="mt-2" />
                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                </div>
                <div>
                    <p class="text-sm text-slate-500">{{ $anggotum->foto ? 'Foto saat ini' : 'Preview foto' }}</p>
                    <img id="foto-preview" src="{{ $anggotum->foto ? asset('storage/' . $anggotum->foto) : '' }}" alt="Foto {{ $anggotum->nama }}" class="mt-2 h-28 w-28 rounded-3xl object-cover {{ $anggotum->foto ? '' : 'hidden' }}" />
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Update Anggota</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputFoto = document.getElementById('foto');
            const previewFoto = document.getElementById('foto-preview');

            if (!inputFoto || !previewFoto) {
                return;
            }

            inputFoto.addEventListener('change', function (event) {
                const file = event.target.files && event.target.files[0];

                if (!file) {
                    return;
                }

                const objectUrl = URL.createObjectURL(file);
                previewFoto.src = objectUrl;
                previewFoto.classList.remove('hidden');
            });
        });
    </script>
</x-app-layout>
