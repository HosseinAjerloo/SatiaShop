<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::users;
        foreach ($users as $user) {
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

            User::create($user);
        }
    }
}
