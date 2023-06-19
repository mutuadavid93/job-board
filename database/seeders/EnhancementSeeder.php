<?php

namespace Database\Seeders;

use App\Models\Enhancement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnhancementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Enhancement::factory()->count(3)->create();
    }
}
