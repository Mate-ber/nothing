<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSubscriptionsCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_subscription(): void
    {
        $user = User::factory()->create([
            'email' => config('services.nothing.admin_email'),
        ]);

        $response = $this->actingAs($user)->post('/admin/subscriptions', [
            'name' => 'Test Subscription',
            'description' => 'Test description',
            'price' => 15.50,
        ]);

        $response->assertRedirect(route('admin.subscriptions.index'));

        $this->assertDatabaseHas('subscriptions', [
            'name' => 'Test Subscription',
            'price' => 1550,
        ]);
    }
}
