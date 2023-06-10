<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomId = random_int(1, 1000); // Generate a random ID between 1 and 1000
        
        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph(),
            'website' => fake()->url(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'logo' => "https://picsum.photos/id/{$randomId}/150/150",
            'industry' => fake()->jobTitle(),
            'size' => 'medium',
            'founded_year' => fake()->numberBetween(1900, 2023),
        ];
    }
}
