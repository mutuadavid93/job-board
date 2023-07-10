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
        Joblisting::factory()->count(100)->create();
    }
}
