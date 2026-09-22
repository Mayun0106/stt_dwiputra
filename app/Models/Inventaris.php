<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    /** @use HasFactory<\Database\Factories\InventarisFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_input' => 'date',
    ];

    public function getKondisiLabelAttribute(): string
    {
        return match ($this->kondisi) {
            'baik' => 'Baik',
            'rusak' => 'Rusak Ringan',
            'hilang' => 'Rusak Berat',
            default => ucfirst((string) $this->kondisi),
        };
    }
}
