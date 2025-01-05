<?php

namespace Database\Seeders\Supllier;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Supplier extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Models\Supplier::SupplierRecord as $supplier)
        {
            \App\Models\Supplier::create($supplier);
        }
    }
}
