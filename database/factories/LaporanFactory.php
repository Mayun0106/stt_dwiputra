<?php

namespace Database\Factories;

use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'tipe' => $this->faker->randomElement(['anggota', 'inventaris', 'kegiatan']),
            'tanggal_laporan' => $this->faker->date(),
            'konten' => $this->faker->paragraph(),
            'file_path' => null,
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'user_id' => 1,
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
