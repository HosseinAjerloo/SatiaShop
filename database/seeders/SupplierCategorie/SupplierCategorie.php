<?php

namespace Database\Seeders\SupplierCategorie;

use App\Models\SupplierCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierCategorie extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (SupplierCategory::SupplierCategoryRecord as $supplierCategory)
        {
            SupplierCategory::create($supplierCategory);
        }
    }
}
