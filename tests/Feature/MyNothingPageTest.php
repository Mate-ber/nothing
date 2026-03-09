<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MyNothingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_my_nothing_page_shows_recent_payments(): void
    {
        $user = User::factory()->create([
            'email' => 'demo@nothing.test',
            'name' => 'Demo Nothing User',
        ]);

        $donation = Donation::factory()->create([
            'amount' => 777,
        ]);

        Payment::factory()->create([
            'user_id' => $user->id,
            'amount' => 777,
            'payment_method' => 'test-my-nothing',
            'payable_id' => $donation->id,
            'payable_type' => Donation::class,
        ]);

        $response = $this->get('/my-nothing');

        $response->assertStatus(200);
        $response->assertSee('My Nothing');
        $response->assertSee('test-my-nothing');
    }
}
