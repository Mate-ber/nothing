<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'payable_id' => null,
            'payable_type' => null,
            'amount' => $this->faker->numberBetween(100, 10_000),
            'payment_method' => $this->faker->randomElement(['test-card', 'test-cash']),
        ];
    }
}
