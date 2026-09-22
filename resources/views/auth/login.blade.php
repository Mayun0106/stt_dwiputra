<x-guest-layout>
    <div class="mx-auto w-full max-w-md px-6 py-8 rounded-[32px] bg-white border border-slate-200 shadow-panel">
        <div class="mb-8 text-center">
            <img src="{{ asset('images/dwi-putra.png') }}" alt="STT Dwi Putra" class="mx-auto mb-4 h-14 w-14 rounded-3xl border border-slate-200 bg-white object-contain p-1 shadow-sm" />
            <h1 class="text-2xl font-bold text-slate-900">Sistem Informasi Manajemen</h1>
            <p class="mt-1 text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">STT Dwi Putra</p>
            <p class="mt-3 text-sm text-slate-500">Kelola anggota, inventaris, kegiatan, dan laporan dengan mudah.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="input-field mt-2" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-slate-600">
                        <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-[#7C3AED] focus:ring-[#7C3AED]" />
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-[#7C3AED] hover:text-[#5b21b6]">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-primary w-full">Login</button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-[#7C3AED] hover:text-[#5b21b6]">Daftar sekarang</a></p>
    </div>
</x-guest-layout>
