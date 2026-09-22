<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanRequest;
use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $tipe = $request->query('tipe');

        $laporans = Laporan::query()
            ->when($search, fn($query) => $query->where('judul', 'like', "%{$search}%"))
            ->when($tipe, fn($query) => $query->where('tipe', $tipe))
            ->orderBy('tanggal_laporan', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('laporan.index', compact('laporans', 'search', 'tipe'));
    }

    public function create()
    {
        abort_unless(Gate::allows('manage-laporan'), 403);

        return view('laporan.create');
    }

    public function store(LaporanRequest $request)
    {
        abort_unless(Gate::allows('manage-laporan'), 403);

        $data = $request->validated();
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('laporan', 'public');
        }
        $data['user_id'] = $request->user()->id;

        Laporan::create($data);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat.');
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        abort_unless(Gate::allows('manage-laporan'), 403);

        return view('laporan.edit', compact('laporan'));
    }

    public function update(LaporanRequest $request, Laporan $laporan)
    {
        abort_unless(Gate::allows('manage-laporan'), 403);

        $data = $request->validated();
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('laporan', 'public');
        }

        $laporan->update($data);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        abort_unless(Gate::allows('manage-laporan'), 403);

        if ($laporan->file_path) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }

    public function preview(Laporan $laporan)
    {
        if (! $laporan->file_path || ! Storage::disk('public')->exists($laporan->file_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($laporan->file_path, $laporan->judul . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION));
    }

    public function exportExcel(Request $request)
    {
        abort_unless(Gate::allows('manage-laporan'), 403);

        $search = $request->query('search');
        $tipe = $request->query('tipe');

        $laporans = Laporan::query()
            ->when($search, fn($query) => $query->where('judul', 'like', "%{$search}%"))
            ->when($tipe, fn($query) => $query->where('tipe', $tipe))
            ->orderBy('tanggal_laporan', 'desc')
            ->get();

        $headers = ['Judul', 'Tipe', 'Tanggal', 'Status', 'Keterangan'];
        $rows = $laporans->map(fn ($laporan) => [
            $laporan->judul,
            ucfirst($laporan->tipe),
            $laporan->tanggal_laporan?->format('d-m-Y'),
            ucfirst($laporan->status),
            $laporan->keterangan ?? '-',
        ])->toArray();

        $filename = 'laporan-' . now()->format('YmdHis') . '.csv';
        $tempPath = storage_path('app/' . $filename);
        $handle = fopen($tempPath, 'w');
        fputcsv($handle, $headers);
        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);

        return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
    }

    public function exportPdf(Request $request)
    {
        abort_unless(Gate::allows('manage-laporan'), 403);

        $search = $request->query('search');
        $tipe = $request->query('tipe');

        $laporans = Laporan::query()
            ->when($search, fn($query) => $query->where('judul', 'like', "%{$search}%"))
            ->when($tipe, fn($query) => $query->where('tipe', $tipe))
            ->orderBy('tanggal_laporan', 'desc')
            ->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('laporans', 'search', 'tipe'));

        return $pdf->download('laporan-' . now()->format('YmdHis') . '.pdf');
    }
}
