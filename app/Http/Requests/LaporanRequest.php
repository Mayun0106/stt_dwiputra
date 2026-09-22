<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LaporanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'tipe' => ['required', Rule::in(['anggota', 'inventaris', 'kegiatan'])],
            'tanggal_laporan' => ['required', 'date'],
            'konten' => ['nullable', 'string'],
            'file_path' => ['nullable', 'file', 'max:2048'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'keterangan' => ['nullable', 'string'],
        ];
    }
}
