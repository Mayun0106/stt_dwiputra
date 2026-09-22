<x-guest-layout>
    <div class="mx-auto w-full max-w-md px-6 py-8 rounded-[32px] bg-white border border-slate-200 shadow-panel">
        <div class="mb-8 text-center">
            <img src="{{ asset('images/dwi-putra.png') }}" alt="STT Dwi Putra" class="mx-auto mb-4 h-14 w-14 rounded-3xl border border-slate-200 bg-white object-contain p-1 shadow-sm" />
            <h1 class="text-2xl font-bold text-slate-900">Sistem Informasi Manajemen</h1>
            <p class="mt-1 text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">STT Dwi Putra</p>
            <p class="mt-3 text-sm text-slate-500">Dapatkan akses penuh ke dashboard manajemen.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <button type="submit" class="btn-primary w-full">Register</button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-[#7C3AED] hover:text-[#5b21b6]">Login di sini</a></p>
    </div>
</x-guest-layout>
