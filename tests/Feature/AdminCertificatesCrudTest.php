<?php

namespace Tests\Feature;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCertificatesCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_certificate(): void
    {
        $user = User::factory()->create([
            'email' => config('services.nothing.admin_email'),
        ]);

        $response = $this->actingAs($user)->post('/admin/certificates', [
            'name' => 'Test Certificate',
            'description' => 'Test description',
            'price' => 12.34,
        ]);

        $response->assertRedirect(route('admin.certificates.index'));

        $this->assertDatabaseHas('certificates', [
            'name' => 'Test Certificate',
        ]);
    }
}
