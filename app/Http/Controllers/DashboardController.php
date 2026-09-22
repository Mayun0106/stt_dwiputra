<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Inventaris;
use App\Models\Kegiatan;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $anggotaCount = Anggota::count();
        $inventarisCount = Inventaris::count();
        $kegiatanCount = Kegiatan::count();
        $userCount = User::count();
        $pengurusCount = User::where('role', 'pengurus')->count();
        $anggotaAktifCount = Anggota::where('status', 'aktif')->count();
        $inventarisDipinjamCount = Inventaris::where('status', 'tidak_tersedia')->count();
        $inventarisRusakCount = Inventaris::where('kondisi', 'rusak')->count();
        $kegiatanBulanIniCount = Kegiatan::whereMonth('tanggal_mulai', Carbon::now()->month)
            ->whereYear('tanggal_mulai', Carbon::now()->year)
            ->count();

        $statusSummary = [
            'anggota' => Anggota::selectRaw("status, count(*) as count")->groupBy('status')->pluck('count', 'status')->toArray(),
            'inventaris' => Inventaris::selectRaw("status, count(*) as count")->groupBy('status')->pluck('count', 'status')->toArray(),
            'kegiatan' => Kegiatan::selectRaw("status, count(*) as count")->groupBy('status')->pluck('count', 'status')->toArray(),
        ];

        $monthlyKegiatan = Kegiatan::query()
            ->selectRaw("strftime('%m', tanggal_mulai) as month, count(*) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->mapWithKeys(function ($total, $month) {
                return [(int) $month => (int) $total];
            })
            ->toArray();

        $inventarisConditionSummary = Inventaris::selectRaw("kondisi, count(*) as count")
            ->groupBy('kondisi')
            ->pluck('count', 'kondisi')
            ->toArray();

        $recentActivities = collect([
            ['title' => 'Anggota baru', 'description' => 'Data anggota terbaru telah dicatat.', 'created_at' => Anggota::latest('created_at')->value('created_at')],
            ['title' => 'Inventaris masuk', 'description' => 'Item inventaris terbaru telah ditambahkan.', 'created_at' => Inventaris::latest('created_at')->value('created_at')],
            ['title' => 'Kegiatan dibuat', 'description' => 'Kegiatan terbaru telah dijadwalkan.', 'created_at' => Kegiatan::latest('created_at')->value('created_at')],
        ])->filter(fn ($item) => $item['created_at'])
            ->sortByDesc('created_at')
            ->values();

        $monthLabels = [];
        $monthData = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthLabels[] = date('M', mktime(0, 0, 0, $month, 1));
            $monthData[] = $monthlyKegiatan[$month] ?? 0;
        }

        return view('dashboard', compact(
            'anggotaCount',
            'inventarisCount',
            'kegiatanCount',
            'userCount',
            'pengurusCount',
            'anggotaAktifCount',
            'inventarisDipinjamCount',
            'inventarisRusakCount',
            'kegiatanBulanIniCount',
            'statusSummary',
            'inventarisConditionSummary',
            'recentActivities',
            'monthLabels',
            'monthData'
        ));
    }
}
