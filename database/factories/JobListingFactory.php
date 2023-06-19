<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'category_id' => Category::pluck('id')->random(),
            'company_id' => Company::pluck('id')->random(),
            'location_id' => Location::pluck('id')->random(),
            'employment_type' => fake()->randomElement(['Full-time', 'Part-time', 'Contract']),
            'salary' => fake()->randomFloat(2, 1000, 50000),
            // 'application_deadline' => fake()->dateTimeBetween('+1 week', '+1 month'),
            'repost_date' => fake()->dateTimeBetween('+1 week', '+1 month'),
            'experience_level' => fake()->randomElement(['Entry Level', 'Mid Level', 'Senior Level', 'Internship']),
            // 'skills' => fake()->sentence(3),
            // 'remote' => false,
        ];
    }
}
