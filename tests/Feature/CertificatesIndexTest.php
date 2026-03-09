<?php

namespace Tests\Feature;

use App\Models\Certificate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificatesIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_certificates_index_displays_certificates(): void
    {
        Certificate::factory()->create(['name' => 'Nothing Gold Certificate']);

        $response = $this->get('/certificates');

        $response->assertStatus(200);
        $response->assertSee('Nothing Certificates');
        $response->assertSee('Nothing Gold Certificate');
    }
}
