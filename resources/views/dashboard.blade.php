<x-app-layout>
    <x-slot name="header">
        <div class="mx-auto flex w-full max-w-[1800px] flex-col px-4 pt-8 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 text-[#7C3AED]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-[18px] w-[18px]">
                            <path d="M4.75 5.25A2.75 2.75 0 0 1 7.5 2.5h9A2.75 2.75 0 0 1 19.25 5.25v13.5A2.75 2.75 0 0 1 16.5 21.5h-9A2.75 2.75 0 0 1 4.75 18.75V5.25Zm2.5 1.5v10.5h8.5V6.75h-8.5Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-['Plus_Jakarta_Sans'] text-[44px] font-bold leading-[1.05] text-[#111827]">Dashboard Pengurus</h2>
                    </div>
                </div>
                <div class="flex items-start gap-4 pl-14">
                    <div class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#7C3AED]"></div>
                    <p class="max-w-2xl text-[16px] font-normal leading-[1.7] text-[#6B7280]">Ikhtisar kegiatan, inventaris, anggota, dan pengguna.</p>
                </div>
            </div>
            <div class="mt-6 h-px w-full border-t border-[#E5E7EB] opacity-70"></div>
        </div>
    </x-slot>

    <div class="mx-auto w-full max-w-[1800px] px-4 pb-8 pt-7 sm:px-6 lg:px-8">
        <div class="grid gap-5 xl:grid-cols-4">
            <div class="card-panel p-8 rounded-[24px] border border-[#EEF2FF] shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Anggota</p>
                    <p class="mt-4 text-[48px] font-extrabold text-slate-950">{{ $anggotaCount }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#7C3AED]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                        <path d="M17.25 6.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM12 12.75c4.125 0 6.75 1.875 6.75 4.5v1.125a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V17.25c0-2.625 2.625-4.5 6.75-4.5Z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-slate-500">Total anggota terdaftar.</p>
        </div>

        <div class="card-panel p-8 rounded-[24px] border border-[#EEF2FF] shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Inventaris</p>
                    <p class="mt-4 text-[48px] font-extrabold text-slate-950">{{ $inventarisCount }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#7C3AED]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                        <path d="M4.5 6.75A2.25 2.25 0 0 1 6.75 4.5h10.5A2.25 2.25 0 0 1 19.5 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 17.25V6.75Zm2.25.75v9h10.5v-9H6.75Zm1.5 1.5h3v3h-3v-3Zm5.25 0h3v3h-3v-3Z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-slate-500">Total item inventaris tersimpan.</p>
        </div>

        <div class="card-panel p-8 rounded-[24px] border border-[#EEF2FF] shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Kegiatan</p>
                    <p class="mt-4 text-[48px] font-extrabold text-slate-950">{{ $kegiatanCount }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#7C3AED]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                        <path d="M7.5 3.75a.75.75 0 0 1 1.5 0V5.25h6V3.75a.75.75 0 0 1 1.5 0V5.25h1.5A2.25 2.25 0 0 1 20.25 7.5v11.25A2.25 2.25 0 0 1 18 21h-12A2.25 2.25 0 0 1 3.75 18.75V7.5A2.25 2.25 0 0 1 6 5.25h1.5V3.75Zm0 4.5v1.5h9V8.25h-9Zm0 3.75v6h9v-6h-9Z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-slate-500">Jumlah kegiatan di sistem.</p>
        </div>

        <div class="card-panel p-8 rounded-[24px] border border-[#EEF2FF] shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Users</p>
                    <p class="mt-4 text-[48px] font-extrabold text-slate-950">{{ $userCount }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#EEF2FF] text-[#7C3AED]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                        <path d="M12 12a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm-7.5 8.25a7.5 7.5 0 0 1 15 0 .75.75 0 0 1-.75.75h-13.5a.75.75 0 0 1-.75-.75Zm7.5-1.5a6 6 0 0 0-5.65 3.75h11.3A6 6 0 0 0 12 18.75Z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-slate-500">Pengguna terdaftar dalam sistem.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-[1.7fr_1fr]">
        <div class="card-panel p-8 rounded-[24px] border border-[#EEF2FF] shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7C3AED]">Grafik Kegiatan Bulanan</p>
                    <h3 class="mt-2 text-[22px] font-bold text-slate-950">Tren kegiatan</h3>
                </div>
                <span class="rounded-full bg-[#EEF2FF] px-3 py-1 text-sm font-semibold text-[#4338CA]">Realtime</span>
            </div>
            @php
                $hasChartData = !empty($monthLabels) && collect($monthData)->sum() > 0;
            @endphp
            <div class="mt-8 min-h-[320px] rounded-[28px] border border-slate-200 bg-white p-4 shadow-sm">
                @if ($hasChartData)
                    <canvas id="kegiatanChart" class="h-full w-full"></canvas>
                @else
                    <div class="flex h-full flex-col items-center justify-center gap-4 rounded-[24px] border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center text-slate-500">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-3xl bg-violet-100 text-violet-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                                <path d="M12 3.75a8.25 8.25 0 1 1 0 16.5 8.25 8.25 0 0 1 0-16.5Zm0 1.5a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5Zm-.75 3.75h1.5v4.5h-1.5V9.0Zm0 6h1.5v1.5h-1.5V15.0Z" />
                            </svg>
                        </div>
                        <p class="max-w-sm text-sm text-slate-600">No activity data available yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="card-panel p-8 rounded-[24px] border border-[#EEF2FF] shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
                <h3 class="text-[22px] font-bold text-slate-950">Aktivitas Terbaru</h3>
                <div class="mt-5 space-y-4">
                    <div class="flex items-start gap-4 rounded-3xl bg-[#F8F3FF] p-4">
                        <div class="mt-1 flex h-11 w-11 items-center justify-center rounded-3xl bg-violet-100 text-violet-700">
                            <span class="text-xl">👥</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between gap-4">
                                <p class="text-sm font-semibold text-slate-950">Anggota baru ditambahkan</p>
                                <span class="text-xs text-slate-500">2 menit lalu</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-600">Profil anggota terbaru dicatat dalam sistem.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-3xl bg-[#F8F3FF] p-4">
                        <div class="mt-1 flex h-11 w-11 items-center justify-center rounded-3xl bg-violet-100 text-violet-700">
                            <span class="text-xl">📦</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between gap-4">
                                <p class="text-sm font-semibold text-slate-950">Inventaris baru ditambahkan</p>
                                <span class="text-xs text-slate-500">11 jam lalu</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-600">Item inventaris terbaru berhasil ditambahkan.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-3xl bg-[#F8F3FF] p-4">
                        <div class="mt-1 flex h-11 w-11 items-center justify-center rounded-3xl bg-violet-100 text-violet-700">
                            <span class="text-xl">📅</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between gap-4">
                                <p class="text-sm font-semibold text-slate-950">Kegiatan baru dibuat</p>
                                <span class="text-xs text-slate-500">1 hari lalu</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-600">Kegiatan baru ditambahkan ke jadwal organisasi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-panel p-8 rounded-[24px] border border-[#EEF2FF] shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
                <h3 class="text-[22px] font-bold text-slate-950">Ringkasan Cepat</h3>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div class="flex h-full flex-col justify-between rounded-3xl bg-[#F8F3FF] p-5">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">Anggota aktif</p>
                            <p class="mt-4 text-3xl font-bold text-slate-950">{{ $statusSummary['anggota']['active'] ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="flex h-full flex-col justify-between rounded-3xl bg-[#F8F3FF] p-5">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">Kegiatan terjadwal</p>
                            <p class="mt-4 text-3xl font-bold text-slate-950">{{ $statusSummary['kegiatan']['scheduled'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('kegiatanChart');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($monthLabels),
                    datasets: [{
                        label: 'Kegiatan per Bulan',
                        data: @json($monthData),
                        fill: true,
                        borderColor: '#7C3AED',
                        backgroundColor: 'rgba(124, 58, 237, 0.15)',
                        tension: 0.35,
                        pointBackgroundColor: '#7C3AED',
                        pointBorderColor: '#fff',
                        pointRadius: 5,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(148, 163, 184, 0.16)' },
                            ticks: { color: '#475569' },
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#475569' },
                        },
                    },
                },
            });
        });
    </script>
</x-app-layout>
