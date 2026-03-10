<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentsIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_payments_index_shows_payments_for_demo_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Demo Nothing User',
        ]);

        $donation = Donation::factory()->create([
            'amount' => 999,
        ]);

        Payment::factory()->create([
            'user_id' => $user->id,
            'amount' => 999,
            'payment_method' => 'test-manual',
            'payable_id' => $donation->id,
            'payable_type' => Donation::class,
        ]);

        $response = $this->actingAs($user)->get('/payments');

        $response->assertStatus(200);
        $response->assertSee('Payments for Demo Nothing User');
        $response->assertSee('test-manual');
    }
}
