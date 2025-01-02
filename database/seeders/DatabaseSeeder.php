<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Doller;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Bank\BankSeeder;
use Database\Seeders\Setting\SettingSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            BankSeeder::class,
            UserSeeder::class
        ]);
    }
}
