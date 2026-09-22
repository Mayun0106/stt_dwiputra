<?php

namespace Database\Factories;

use App\Models\Inventaris;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inventaris>
 */
class InventarisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = ['Laptop', 'Proyektor', 'Mic Wireless', 'Kursi', 'Meja', 'Printer', 'Speaker'];

        return [
            'kode_barang' => 'BRG-' . $this->faker->unique()->numberBetween(100, 999),
            'nama_barang' => $this->faker->randomElement($items),
            'kategori' => $this->faker->randomElement(['Peralatan', 'Furniture', 'Teknologi', 'Perlengkapan']),
            'jumlah' => $this->faker->numberBetween(1, 20),
            'lokasi' => $this->faker->randomElement(['Ruang Sekretariat', 'Ruang Rapat', 'Gudang', 'Lab Komputer']),
            'kondisi' => $this->faker->randomElement(['baik', 'rusak', 'hilang']),
            'tanggal_input' => $this->faker->date(),
            'status' => $this->faker->randomElement(['tersedia', 'tidak_tersedia']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
