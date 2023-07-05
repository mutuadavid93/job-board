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

        // if(!in_array($type, $jobListing->fresh()->enhancements->pluck('type')->toArray())) {
        //     dd($jobListing->enhancements->pluck('type')->toArray(), $type);
        //         return [
        //         "joblisting_id" => $jobListing->id,
        //         'type' => $type,
        //         'expiration_date' => fake()->dateTimeBetween('+1 month', '+2 months'),
        //         'recurring' => fake()->boolean(),
        //     ];
        // }

        return [
            // "joblisting_id" => $jobListing->id,
            'type' => $type,
            'price' => $this->faker->randomFloat(2, 49, 1499),
            'expiration_date' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'recurring' => fake()->boolean(),
        ];
    }

    // public function definition(): array
    // {
    //     $jobListing = Joblisting::inRandomOrder()->first();
    //     $enhancementTypes = ['Boost every day', 'Boost every 7 days'];

    //     if (!Enhancement::where('joblisting_id', $jobListing->id)->exists()) {
    //         return [
    //             'joblisting_id' => $jobListing->id,
    //             'type' => 'Company Logo',
    //             'expiration_date' => fake()->dateTimeBetween('+1 month', '+2 months'),
    //             'recurring' => fake()->boolean(),
    //         ];
    //     }

    //     $existingTypes = Enhancement::where('joblisting_id', $jobListing->id)->pluck('type')->toArray();
    //     $availableTypes = array_diff($enhancementTypes, $existingTypes);

    //     if (!empty($availableTypes)) {
    //         $type = fake()->randomElement($availableTypes);

    //         return [
    //             'joblisting_id' => $jobListing->id,
    //             'type' => $type,
    //             'expiration_date' => fake()->dateTimeBetween('+1 month', '+2 months'),
    //             'recurring' => fake()->boolean(),
    //         ];
    //     }

    //     return [];
    // }
}
