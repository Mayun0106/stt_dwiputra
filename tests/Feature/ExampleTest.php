<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_detail_page_can_be_rendered(): void
    {
        $user = User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'role' => 'pengurus',
        ]);

        $response = $this->actingAs($user)->get(route('users.show', $user));

        $response->assertStatus(200);
        $response->assertSee('Detail User');
        $response->assertSee('Budi Santoso');
    }
}
