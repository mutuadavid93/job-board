<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Joblisting;
use App\Models\Enhancement;
use App\Models\EnhancementJoblisting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JoblistingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id = rand(1, 100);
        return [
            'title' => $this->faker->jobTitle(),
            'company_name' => $this->faker->company(),
            'company_logo' => "https://picsum.photos/id/{$id}/200/300",
            'description' => $this->faker->paragraph(),
            'employment_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'location' => $this->faker->randomElement([$this->faker->city, 'New York', 'Remote/USA']),
            'salary' => $this->faker->randomFloat(2, 1000, 50000),
            'experience_level' => $this->faker->randomElement(['Entry Level', 'Mid Level', 'Senior Level', 'Internship']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Joblisting $joblisting) {
            $enhancements = Enhancement::inRandomOrder()->get();

            foreach ($enhancements as $enhancement) {
                $joblisting->enhancements()->attach($enhancement);
            }
        });
    }


}
