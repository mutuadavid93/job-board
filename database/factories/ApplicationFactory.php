<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'job_id' => Job::pluck('id')->random(),
            'cover_letter' => fake()->paragraph(),
            'resume' => 'path/to/resume.pdf',
            'status' => fake()->randomElement(['Pending', 'Accepted', 'Rejected']),
            'rating' => fake()->numberBetween(1, 5),
            'additional_documents' => null
        ];
    }
}
