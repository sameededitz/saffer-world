<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDevice>
 */
class UserDeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'device_name' => $this->faker->word,
            'device_id' => $this->faker->uuid,
            'ip_address' => $this->faker->ipv4,
            'platform' => $this->faker->word
        ];
    }
}
