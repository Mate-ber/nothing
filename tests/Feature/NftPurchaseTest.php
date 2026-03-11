<?php

namespace Tests\Feature;

use App\Models\Nft;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NftPurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_nft_purchase_creates_payment(): void
    {
        $user = User::factory()->create();

        $nft = Nft::factory()->create([
            'price' => 4321,
        ]);

        $response = $this->actingAs($user)
            ->post("/nfts/{$nft->id}/purchase", [
                'card_name' => 'Test User',
                'card_number' => '4242424242424242',
                'card_expiry' => '12/30',
                'card_cvc' => '123',
            ]);

        $response->assertRedirect('/nfts');

        $this->assertDatabaseHas('payments', [
            'payment_method' => 'test-nft',
            'amount' => 4321,
        ]);
    }
}
