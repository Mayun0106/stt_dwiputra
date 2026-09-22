<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Anggota>
 */
class AnggotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'I Made Dharma Putra',
            'Kadek Yoga Pratama',
            'Komang Agus Saputra',
            'Putu Ari Wibawa',
            'Ni Luh Sri Dewi',
            'Ketut Adi Saputra',
        ];
        $positions = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Koordinator Inventaris', 'Koordinator Kegiatan', 'Anggota'];

        return [
            'nama' => $this->faker->randomElement($names),
            'email' => $this->faker->unique()->safeEmail(),
            'nomor_hp' => $this->faker->phoneNumber(),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'alamat' => 'Denpasar, Bali',
            'jabatan' => $this->faker->randomElement($positions),
            'foto' => null,
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
            'keterangan' => $this->faker->sentence(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tanggal_bergabung' => $this->faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
        ];
    }
}
