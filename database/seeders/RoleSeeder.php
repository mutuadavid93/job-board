<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        Role::create(["name"=>"admin"]);
        Role::create(["name"=>"employer"]);
        Role::create(["name"=>"job_seeker"]);
        Role::create(["name"=>"user"]); // Normal guest
    }
}
