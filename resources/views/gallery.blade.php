<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-950">Galeri Kegiatan</h2>
                <p class="mt-1 text-sm text-slate-500">Dokumentasi singkat kegiatan STT Dwi Putra.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#7C3AED] hover:text-[#7C3AED]">Kembali</a>
        </div>
    </x-slot>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ([
            [
                'title' => 'Rapat Pengurus',
                'caption' => 'Diskusi program kerja dan evaluasi kegiatan.',
                'badge' => 'Terbaru',
                'image' => asset('images/rapat pengurus dan kelian banjar.jpeg'),
            ],
            [
                'title' => 'Lomba Futsal Antar Banjar',
                'caption' => 'Pertandingan futsal antarbaan yang seru, sportif, dan membawa semangat kebersamaan.',
                'badge' => 'Olahraga',
                'image' => asset('images/futsal.jpeg'),
            ],
            [
                'title' => 'Pembuatan Ogoh-Ogoh',
                'caption' => 'Proses pembuatan ogoh-ogoh bersama dengan kreativitas dan kekompakan tim.',
                'badge' => 'Budaya',
                'image' => asset('images/membuat ogoh-ogoh.jpeg'),
            ],
            [
                'title' => 'Lomba Ogoh-Ogoh',
                'caption' => 'Kegiatan lomba ogoh-ogoh yang penuh kreativitas dan semangat budaya.',
                'badge' => 'Budaya',
                'image' => asset('images/lomba ogoh-ogoh di puputan.jpeg'),
            ],
            [
                'title' => 'Pembuatan Gapura',
                'caption' => 'Proses pembuatan gapura dengan semangat gotong royong dan kreativitas.',
                'badge' => 'Kreatif',
                'image' => asset('images/membuat gapura.jpeg'),
            ],
            [
                'title' => 'Lomba Megambel',
                'caption' => 'Kegiatan lomba megambel dengan semangat kebersamaan dan kreativitas.',
                'badge' => 'Lomba',
                'image' => asset('images/lomba megambel .jpeg'),
            ],
        ] as $item)
            <div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-panel">
                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="h-44 w-full object-cover" loading="lazy" />
                <div class="p-6">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="text-lg font-semibold text-slate-950">{{ $item['title'] }}</h3>
                        <span class="rounded-full bg-[#F8F3FF] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#7C3AED]">{{ $item['badge'] }}</span>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['caption'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
