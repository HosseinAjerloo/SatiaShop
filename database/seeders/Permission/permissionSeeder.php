<?php

namespace Database\Seeders\Permission;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Permission::permission as $permission) {
            $permissionID = Permission::create($permission);
            foreach (Role::all() as $role) {
                $role->permissions()->attach($permissionID);
            }
        }

    }
}
