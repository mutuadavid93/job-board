<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::pluck('id')->random(),
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'country' => fake()->country(),
            'city' => fake()->city(),
        ];
    }
}
