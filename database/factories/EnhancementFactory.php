<?php

namespace Database\Factories;

use App\Models\Enhancement;
use App\Models\Joblisting;
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
        // $jobListing = Joblisting::inRandomOrder()->first();
        $type = fake()->randomElement(['Boost every day', "Boost every 7 days"]);

        return [
            // "joblisting_id" => $jobListing->id,
            'type' => $type,
            'price' => $this->faker->randomFloat(2, 49, 1499),
            'expiration_date' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'recurring' => fake()->boolean(),
            // 'color' => fake()->hexColor,
            // 'text_color' => fake()->hexColor,
            'color' =>  fake()->hexColor,
            'text_color' =>  fake()->hexColor,
        ];
    }
}
