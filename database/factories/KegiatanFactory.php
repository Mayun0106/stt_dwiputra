<?php

namespace Database\Factories;

use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kegiatan>
 */
class KegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalMulai = $this->faker->dateTimeBetween('-30 days', '+30 days')->format('Y-m-d');
        $selesaiDate = strtotime($tanggalMulai . ' +14 days');
        $tanggalSelesai = date('Y-m-d', $selesaiDate);
        return [
            'nama' => $this->faker->randomElement(['Rapat Pengurus', 'Pelatihan Anggota', 'Kegiatan Sosial', 'Workshop Teknologi', 'Bakti Sosial']),
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'lokasi' => $this->faker->randomElement(['Sekretariat STT', 'Ruang Serbaguna', 'Lapangan', 'Lab Komputer']),
            'deskripsi' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['upcoming', 'berlangsung', 'selesai']),
            'keterangan' => $this->faker->sentence(),
            'jam' => $this->faker->randomElement(['08:00', '09:30', '13:00', '15:00']),
            'penanggung_jawab' => $this->faker->randomElement(['Ketut Adi Saputra', 'Kadek Yoga Pratama', 'Putu Ari Wibawa']),
            'foto_dokumentasi' => null,
        ];
    }
}
