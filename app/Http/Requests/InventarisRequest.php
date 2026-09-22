<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'kondisi' => ['required', Rule::in(['baik', 'rusak', 'hilang'])],
            'tanggal_input' => ['required', 'date'],
            'status' => ['required', Rule::in(['tersedia', 'tidak_tersedia'])],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kategori.required' => 'Kategori barang wajib dipilih.',
            'jumlah.required' => 'Jumlah barang wajib diisi.',
            'jumlah.integer' => 'Jumlah barang harus berupa angka.',
            'tanggal_input.required' => 'Tanggal input wajib diisi.',
            'tanggal_input.date' => 'Tanggal input harus berupa tanggal yang valid.',
        ];
    }
}
