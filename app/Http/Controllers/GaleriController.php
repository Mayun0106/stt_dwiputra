<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(Gate::allows('view-gallery'), 403);

        $search = $request->query('search');
        $galeris = Galeri::query()
            ->when($search, fn ($query) => $query->where('judul', 'like', "%{$search}%"))
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('galeri.index', compact('galeris', 'search'));
    }

    public function create()
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        return view('galeri.create');
    }

    public function store(Request $request)
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'judul.required' => 'Judul galeri wajib diisi.',
            'foto.required' => 'Foto galeri wajib diunggah.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'foto.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $data['user_id'] = $request->user()->id;
        Galeri::create($data);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(Galeri $galeri)
    {
        abort_unless(Gate::allows('view-gallery'), 403);

        return view('galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'judul.required' => 'Judul galeri wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'foto.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        abort_unless(Gate::allows('manage-kegiatan'), 403);

        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
