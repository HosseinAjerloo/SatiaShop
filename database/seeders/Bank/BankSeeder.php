<?php

namespace Database\Seeders\Bank;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Bank::Banks as $bank)
        {
            Bank::create($bank);
        }
    }
}
