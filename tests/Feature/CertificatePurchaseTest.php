<?php

namespace Tests\Feature;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificatePurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_certificate_purchase_creates_payment(): void
    {
        $user = User::factory()->create();

        $certificate = Certificate::factory()->create([
            'price' => 1234,
        ]);

        $response = $this->actingAs($user)
            ->post("/certificates/{$certificate->id}/purchase", [
                'card_name' => 'Test User',
                'card_number' => '4242424242424242',
                'card_expiry' => '12/30',
                'card_cvc' => '123',
            ]);

        $response->assertRedirect('/certificates');

        $this->assertDatabaseHas('payments', [
            'payment_method' => 'test-certificate',
            'amount' => 1234,
        ]);
    }
}
