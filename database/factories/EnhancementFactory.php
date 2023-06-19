<?php

namespace Database\Factories;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enhancement>
 */
class EnhancementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'joblisting_id' => JobListing::pluck('id')->random(),
            'type' => fake()->randomElement(['Logo', 'Boost']),
            'expiration_date' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'recurring' => fake()->boolean(),
        ];
    }
}
