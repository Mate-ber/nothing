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
        User::factory()->create([
            'email' => 'demo@nothing.test',
        ]);

        $nft = Nft::factory()->create([
            'price' => 4321,
        ]);

        $response = $this->post("/nfts/{$nft->id}/purchase");

        $response->assertRedirect('/nfts');

        $this->assertDatabaseHas('payments', [
            'payment_method' => 'test-nft',
            'amount' => 4321,
        ]);
    }
}
