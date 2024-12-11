<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bundle_id' => fake()->numberBetween(1000, 9999),
            'name' => fake()->monthName(),
            'description' => fake()->text(20),
            'price' => fake()->numberBetween(10, 100),
            'duration' => 'weekly',
            'type' => 'trial',
        ];
    }
    public function trial(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'bundle_id' => fake()->numberBetween(1000, 9999),
                'name' => 'Free Trial',
                'description' => 'Free Trial Plan (Dont Delete)',
                'price' => '0.00',
                'duration' => 'daily',
                'type' => 'trial',
            ];
        });
    }
}
