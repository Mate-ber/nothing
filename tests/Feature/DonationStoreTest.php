<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_donation_creates_donation_and_payment(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/donations', [
                'amount' => 5.00,
            ]);

        $response->assertRedirect('/donations/create');

        $this->assertDatabaseHas('donations', [
            'campaign_id' => 'nothing-general',
            'amount' => 500,
        ]);

        $this->assertDatabaseHas('payments', [
            'payment_method' => 'test-donation',
            'amount' => 500,
        ]);
    }
}
