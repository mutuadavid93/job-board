<?php

namespace Database\Seeders;

use App\Models\Joblisting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;

class JoblistingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Joblisting::factory()->count(10)->create();

        $jobListings = Joblisting::all();
        foreach($jobListings as $jobListing) {
            //Assign Company logo enhancement
            $jobListing->enhancements()->create([
                'type' => 'Company Logo',
                "expiration_date" => Carbon::now()->addDays(7),
                "recurring" => false,
            ]);
        }
    }
}
