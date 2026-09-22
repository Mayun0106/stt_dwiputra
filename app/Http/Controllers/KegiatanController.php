<?php

namespace App\Http\Controllers;

use App\Http\Requests\KegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $kegiatans = Kegiatan::query()
            ->when($search, fn($query) => $query->where('nama', 'like', "%{$search}%"))
            ->when($status, fn($query) => $query->where('status', $status))
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('kegiatan.index', compact('kegiatans', 'search', 'status'));
    }

    public function create()
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        return view('kegiatan.create');
    }

    public function store(KegiatanRequest $request)
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        Kegiatan::create($request->validated());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(KegiatanRequest $request, Kegiatan $kegiatan)
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        $kegiatan->update($request->validated());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
