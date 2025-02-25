<?php

namespace Database\Seeders\Brand;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Brand::Brands as $brand)
        {
            Brand::create($brand);
        }
    }
}
