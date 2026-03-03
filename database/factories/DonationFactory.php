<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'campaign_id' => $this->faker->randomElement(['nothing-general', 'nothing-research', 'nothing-dev']),
            'amount' => $this->faker->numberBetween(100, 5_000),
        ];
    }
}
