<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventarisRequest;
use App\Models\Inventaris;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $kondisi = $request->query('kondisi');

        $inventaris = Inventaris::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%{$search}%")
                      ->orWhere('kode_barang', 'like', "%{$search}%");
                });
            })
            ->when($kondisi, fn($query) => $query->where('kondisi', $kondisi))
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('inventaris.index', compact('inventaris', 'search', 'kondisi'));
    }

    public function exportExcel(Request $request)
    {
        abort_unless(Gate::allows('manage-inventaris'), 403);

        $inventaris = Inventaris::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama_barang', 'like', "%{$request->search}%")
                      ->orWhere('kode_barang', 'like', "%{$request->search}%");
                });
            })
            ->when($request->filled('kondisi'), fn ($query) => $query->where('kondisi', $request->kondisi))
            ->orderBy('nama_barang')
            ->get();

        $filename = 'data-inventaris-' . now()->format('YmdHis') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($inventaris) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Kode Barang', 'Nama Barang', 'Kategori', 'Jumlah', 'Kondisi', 'Lokasi', 'Status', 'Tanggal Input']);

            foreach ($inventaris as $item) {
                fputcsv($handle, [
                    $item->kode_barang ?? '-',
                    $item->nama_barang,
                    $item->kategori ?? '-',
                    $item->jumlah,
                    $item->kondisi_label,
                    $item->lokasi ?? '-',
                    ucfirst($item->status ?? '-'),
                    $item->tanggal_input ? $item->tanggal_input->format('d/m/Y') : '-',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        abort_unless(Gate::allows('manage-inventaris'), 403);

        $inventaris = Inventaris::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama_barang', 'like', "%{$request->search}%")
                      ->orWhere('kode_barang', 'like', "%{$request->search}%");
                });
            })
            ->when($request->filled('kondisi'), fn ($query) => $query->where('kondisi', $request->kondisi))
            ->orderBy('nama_barang')
            ->get();

        $pdf = Pdf::loadView('inventaris.export-pdf', [
            'inventaris' => $inventaris,
            'printedAt' => now()->format('d M Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-inventaris-' . now()->format('YmdHis') . '.pdf');
    }

    public function create()
    {
        abort_unless(Gate::allows('manage-inventaris'), 403);

        return view('inventaris.create');
    }

    public function store(InventarisRequest $request)
    {
        abort_unless(Gate::allows('manage-inventaris'), 403);

        Inventaris::create($request->validated());

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function show(Inventaris $inventaris)
    {
        return view('inventaris.show', compact('inventaris'));
    }

    public function edit(Inventaris $inventaris)
    {
        abort_unless(Gate::allows('manage-inventaris'), 403);

        return view('inventaris.edit', compact('inventaris'));
    }

    public function update(InventarisRequest $request, Inventaris $inventaris)
    {
        abort_unless(Gate::allows('manage-inventaris'), 403);

        $data = $request->validated();
        unset($data['foto']);

        if ($request->hasFile('foto')) {
            if ($inventaris->foto) {
                Storage::disk('public')->delete($inventaris->foto);
            }

            $data['foto'] = $request->file('foto')->store('inventaris', 'public');
        }

        $inventaris->update($data);

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventaris)
    {
        abort_unless(Gate::allows('manage-inventaris'), 403);

        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil dihapus.');
    }
}
