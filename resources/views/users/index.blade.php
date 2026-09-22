<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Users</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola pengguna sistem dan peran akses.</p>
            </div>
            @can('manage-users')
                <a href="{{ route('users.create') }}" class="btn-primary">Tambah User</a>
            @endcan
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-[28px] border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 rounded-[28px] border border-slate-200 bg-white p-6 shadow-panel">
        <form class="grid gap-4 md:grid-cols-[1fr_auto]" method="GET" action="{{ route('users.index') }}">
            <input type="search" name="search" placeholder="Cari nama, email, atau username..." value="{{ $search }}" class="input-field" />
            <button type="submit" class="btn-primary">Cari</button>
        </form>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-200 shadow-panel">
        <table class="min-w-full divide-y divide-slate-200 bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Username</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Role</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $user->username ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm font-semibold {{ $user->role === 'pengurus' ? 'text-emerald-600' : 'text-slate-500' }}">{{ ucfirst($user->role) }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('users.show', $user) }}" class="mr-2 text-slate-600 hover:text-[#7C3AED]">Detail</a>
                            @can('manage-users')
                                <a href="{{ route('users.edit', $user) }}" class="mr-2 text-[#7C3AED] hover:text-[#5b21b6]">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>Hapus</x-danger-button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada user. Tambahkan user baru untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</x-app-layout>
