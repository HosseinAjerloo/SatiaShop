<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            foreach (Role::RoleName as $role)
            {
                $role=Role::create($role);
                foreach (User::all() as $user)
                {
                    $user->roles()->attach($role);
                }

            }

    }
}
