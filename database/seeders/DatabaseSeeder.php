<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Anggota;
use App\Models\Inventaris;
use App\Models\Kegiatan;
use App\Models\Laporan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create pengurus user
        $pengurus = User::factory()->create([
            'name' => 'Pengurus STT Dwi Putra',
            'email' => 'pengurus@sttdwiputra.com',
            'username' => 'pengurus',
            'password' => bcrypt('password'),
            'role' => 'pengurus',
        ]);

        // Create regular anggota
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testuser',
            'password' => bcrypt('password'),
            'role' => 'anggota',
        ]);

        // Create test data
        Anggota::factory(20)->create();
        Inventaris::factory(25)->create();
        Kegiatan::factory(15)->create();
        Laporan::factory(10)->create(['user_id' => $pengurus->id]);
    }
}
