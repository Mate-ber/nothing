<?php

namespace Tests\Feature;

use App\Models\Nft;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminNftsCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_nft(): void
    {
        $user = User::factory()->create([
            'email' => config('services.nothing.admin_email'),
        ]);

        $response = $this->actingAs($user)->post('/admin/nfts', [
            'name' => 'Test NFT',
            'blockchain_id' => 'chain-123',
            'price' => 9.99,
        ]);

        $response->assertRedirect(route('admin.nfts.index'));

        $this->assertDatabaseHas('nfts', [
            'name' => 'Test NFT',
        ]);
    }
}
