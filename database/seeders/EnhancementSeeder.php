<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Joblisting;
use App\Models\Enhancement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnhancementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Enhancement::factory()->count(100)->create();
    }
}
