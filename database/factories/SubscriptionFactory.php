<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Monthly Nothing',
                'Premium Nothing',
                'Infinite Nothing',
            ]),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomElement([500, 999, 1999]),
        ];
    }
}
