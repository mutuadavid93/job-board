<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all available roles
        $roles = Role::all();
        $users = 3;

        // Fake couple users
        User::factory()
            ->count($users)
            ->create()
            ->each(function ($user) use ($roles) {
                $randomRole = $roles->random();

                // Finally assign a role to a user
                $user->assignRole($randomRole);
            });
    }
}
