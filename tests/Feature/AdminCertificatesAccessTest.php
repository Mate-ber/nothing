<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCertificatesAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_certificates_index(): void
    {
        $response = $this->get('/admin/certificates');

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_admin_certificates_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/admin/certificates');

        $response->assertStatus(200);
        $response->assertSee('Admin: Certificates');
    }
}
