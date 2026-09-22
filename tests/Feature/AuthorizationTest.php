<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_anggota_cannot_access_anggota_create_page(): void
    {
        $user = User::factory()->create([
            'role' => 'anggota',
        ]);

        $response = $this->actingAs($user)->get(route('anggota.create'));

        $response->assertForbidden();
    }

    public function test_anggota_can_access_gallery_index_page(): void
    {
        $user = User::factory()->create([
            'role' => 'anggota',
        ]);

        $response = $this->actingAs($user)->get(route('galeri.index'));

        $response->assertOk();
    }

    public function test_pengurus_can_export_laporan_pdf(): void
    {
        $user = User::factory()->create([
            'role' => 'pengurus',
        ]);

        $response = $this->actingAs($user)->get(route('laporan.export.pdf', ['search' => 'Rapat', 'tipe' => 'kegiatan']));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_pengurus_can_access_inventaris_index_and_see_new_inventory_title(): void
    {
        $user = User::factory()->create([
            'role' => 'pengurus',
        ]);

        $response = $this->actingAs($user)->get(route('inventaris.index'));

        $response->assertOk();
        $response->assertSee('Inventaris Barang');
        $response->assertSee('Cari nama barang atau kode inventaris...');
        $response->assertSee('Export Excel');
    }

    public function test_pengurus_can_export_inventaris_excel(): void
    {
        $user = User::factory()->create([
            'role' => 'pengurus',
        ]);

        $response = $this->actingAs($user)->get(route('inventaris.export.excel'));

        $response->assertOk();
    }
}
