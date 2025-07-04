<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bl_release_date' => $this->faker->date(),
            'bl_release_user_id' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
            'freight_payer_self' => $this->faker->boolean(),
            'contract_number' => $this->faker->randomNumber(),
            'bl_number' => $this->faker->randomNumber(),
        ];
    }
}
