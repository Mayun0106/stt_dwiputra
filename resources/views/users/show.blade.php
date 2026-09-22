<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Detail User</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi lengkap akun pengguna sistem.</p>
            </div>
            <a href="{{ route('users.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-[1fr_0.9fr]">
        <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="flex h-20 w-20 items-center justify-center rounded-3xl bg-[#F8F3FF] text-xl font-semibold text-[#7C3AED]">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-slate-950">{{ $user->name }}</h3>
                        <p class="text-sm text-slate-500">{{ $user->username ?? 'Tidak ada username' }}</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-[#F8F3FF] p-4">
                        <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Email</p>
                        <p class="mt-2 text-sm text-slate-700">{{ $user->email }}</p>
                    </div>
                    <div class="rounded-3xl bg-[#F8F3FF] p-4">
                        <p class="text-sm uppercase tracking-[0.24em] text-[#7C3AED]">Role</p>
                        <p class="mt-2 text-sm font-semibold {{ $user->role === 'pengurus' ? 'text-emerald-600' : 'text-slate-600' }}">{{ ucfirst($user->role) }}</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Status Akun</p>
                        <p class="mt-2 text-slate-900">{{ $user->email_verified_at ? 'Terverifikasi' : 'Belum diverifikasi' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Dibuat</p>
                        <p class="mt-2 text-slate-900">{{ optional($user->created_at)->format('d M Y H:i') ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-panel">
            <h3 class="text-lg font-semibold text-slate-950">Aksi Cepat</h3>
            <div class="mt-4 space-y-3">
                <a href="{{ route('users.edit', $user) }}" class="block rounded-3xl border border-[#7C3AED] bg-[#F8F3FF] px-5 py-3 text-sm font-semibold text-[#7C3AED] transition hover:bg-[#F5EEFF]">Edit User</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-3xl bg-rose-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Hapus User</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
