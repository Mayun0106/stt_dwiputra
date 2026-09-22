<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Inventaris;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index', [
            'anggotaCount' => Anggota::count(),
            'inventarisCount' => Inventaris::count(),
            'kegiatanCount' => Kegiatan::count(),
        ]);
    }

    public function anggota()
    {
        return view('report.anggota', [
            'anggotas' => Anggota::orderBy('nama')->get(),
            'count' => Anggota::count(),
        ]);
    }

    public function inventaris()
    {
        return view('report.inventaris', [
            'inventaris' => Inventaris::orderBy('nama_barang')->get(),
            'count' => Inventaris::count(),
        ]);
    }

    public function kegiatan()
    {
        return view('report.kegiatan', [
            'kegiatans' => Kegiatan::orderBy('tanggal_mulai', 'desc')->get(),
            'count' => Kegiatan::count(),
        ]);
    }

    public function exportPdfAnggota()
    {
        $anggotas = Anggota::orderBy('nama')->get();
        $rows = $anggotas->map(function ($item, $index) {
            return [
                $index + 1,
                $item->nama,
                $item->jabatan ?? '-',
                $item->alamat ?? '-',
                $item->nomor_hp ?? '-',
                ucfirst($item->status ?? '-'),
            ];
        })->toArray();

        $pdf = Pdf::loadView('report.pdf', [
            'title' => 'Laporan Anggota',
            'subtitle' => 'Data anggota terdaftar STT Dwi Putra',
            'headers' => ['No', 'Nama', 'Jabatan', 'Alamat', 'Nomor HP', 'Status'],
            'rows' => $rows,
            'printedAt' => now()->format('d M Y'),
            'logo' => $this->logoDataUrl(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-anggota-' . now()->format('YmdHis') . '.pdf');
    }

    public function exportPdfInventaris()
    {
        $items = Inventaris::orderBy('nama_barang')->get();
        $rows = $items->map(function ($item, $index) {
            return [
                $index + 1,
                $item->nama_barang,
                $item->kategori ?? '-',
                $item->jumlah,
                ucfirst($item->kondisi ?? '-'),
                ucfirst(str_replace('_', ' ', $item->status ?? '-')),
            ];
        })->toArray();

        $pdf = Pdf::loadView('report.pdf', [
            'title' => 'Laporan Inventaris',
            'subtitle' => 'Data inventaris STT Dwi Putra',
            'headers' => ['No', 'Nama Barang', 'Kategori', 'Jumlah', 'Kondisi', 'Status'],
            'rows' => $rows,
            'printedAt' => now()->format('d M Y'),
            'logo' => $this->logoDataUrl(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-inventaris-' . now()->format('YmdHis') . '.pdf');
    }

    public function exportPdfKegiatan()
    {
        $items = Kegiatan::orderBy('tanggal_mulai', 'desc')->get();
        $rows = $items->map(function ($item, $index) {
            return [
                $index + 1,
                $item->nama,
                optional($item->tanggal_mulai)->format('d M Y') ?: '-',
                $item->lokasi ?? '-',
                $item->deskripsi ?? '-',
                ucfirst($item->status ?? '-'),
            ];
        })->toArray();

        $pdf = Pdf::loadView('report.pdf', [
            'title' => 'Laporan Kegiatan',
            'subtitle' => 'Data kegiatan STT Dwi Putra',
            'headers' => ['No', 'Nama Kegiatan', 'Tanggal', 'Lokasi', 'Deskripsi', 'Status'],
            'rows' => $rows,
            'printedAt' => now()->format('d M Y'),
            'logo' => $this->logoDataUrl(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-kegiatan-' . now()->format('YmdHis') . '.pdf');
    }

    public function printAnggota()
    {
        return view('report.print', [
            'title' => 'Laporan Anggota',
            'rows' => Anggota::orderBy('nama')->get(),
            'columns' => ['No', 'Nama', 'Jabatan', 'Alamat', 'Nomor HP', 'Status'],
            'count' => Anggota::count(),
            'type' => 'anggota',
        ]);
    }

    public function printInventaris()
    {
        return view('report.print', [
            'title' => 'Laporan Inventaris',
            'rows' => Inventaris::orderBy('nama_barang')->get(),
            'columns' => ['No', 'Nama Barang', 'Kategori', 'Jumlah', 'Kondisi', 'Status'],
            'count' => Inventaris::count(),
            'type' => 'inventaris',
        ]);
    }

    public function printKegiatan()
    {
        return view('report.print', [
            'title' => 'Laporan Kegiatan',
            'rows' => Kegiatan::orderBy('tanggal_mulai', 'desc')->get(),
            'columns' => ['No', 'Nama Kegiatan', 'Tanggal', 'Lokasi', 'Deskripsi', 'Status'],
            'count' => Kegiatan::count(),
            'type' => 'kegiatan',
        ]);
    }

    protected function logoDataUrl()
    {
        $path = public_path('images/logo-stt.jpeg');
        if (! file_exists($path)) {
            $path = public_path('images/dwi-putra.png');
        }

        return file_exists($path)
            ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path))
            : '';
    }
}
