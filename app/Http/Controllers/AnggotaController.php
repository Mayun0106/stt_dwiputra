<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaRequest;
use App\Models\Anggota;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $anggotas = Anggota::query()
            ->when($search, fn($query) => $query->where('nama', 'like', "%{$search}%"))
            ->when($status, fn($query) => $query->where('status', $status))
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('anggota.index', compact('anggotas', 'search', 'status'));
    }

    public function exportExcel(Request $request)
    {
        abort_unless(Gate::allows('manage-anggota'), 403);

        $anggotas = Anggota::query()
            ->when($request->filled('search'), fn ($query) => $query->where('nama', 'like', "%{$request->search}%"))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->orderBy('nama')
            ->get();

        $filename = 'data-anggota-' . now()->format('YmdHis') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($anggotas) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Nama', 'Jabatan', 'Email', 'Nomor HP', 'Alamat', 'Tanggal Lahir', 'Status']);

            foreach ($anggotas as $anggota) {
                fputcsv($handle, [
                    $anggota->nama,
                    $anggota->jabatan ?? '-',
                    $anggota->email ?? '-',
                    $anggota->nomor_hp ?? '-',
                    $anggota->alamat ?? '-',
                    $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d/m/Y') : '-',
                    ucfirst($anggota->status ?? '-'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        abort_unless(Gate::allows('manage-anggota'), 403);

        $anggotas = Anggota::query()
            ->when($request->filled('search'), fn ($query) => $query->where('nama', 'like', "%{$request->search}%"))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->orderBy('nama')
            ->get();

        $pdf = Pdf::loadView('anggota.export-pdf', [
            'anggotas' => $anggotas,
            'printedAt' => now()->format('d M Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-anggota-' . now()->format('YmdHis') . '.pdf');
    }

    public function create()
    {
        abort_unless(Gate::allows('manage-anggota'), 403);

        return view('anggota.create');
    }

    public function store(AnggotaRequest $request)
    {
        abort_unless(Gate::allows('manage-anggota'), 403);

        $data = $request->validated();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        Anggota::create($data);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggotum)
    {
        return view('anggota.show', compact('anggotum'));
    }

    public function edit(Anggota $anggotum)
    {
        abort_unless(Gate::allows('manage-anggota'), 403);

        return view('anggota.edit', compact('anggotum'));
    }

    public function update(AnggotaRequest $request, Anggota $anggotum)
    {
        abort_unless(Gate::allows('manage-anggota'), 403);

        $data = $request->validated();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        $anggotum->update($data);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggotum)
    {
        abort_unless(Gate::allows('manage-anggota'), 403);

        if ($anggotum->foto) {
            Storage::disk('public')->delete($anggotum->foto);
        }

        $anggotum->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
