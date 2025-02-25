<?php

namespace Database\Seeders\Category;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Category::CategoryRecord as $category)
            {
                Category::create($category);
            }
    }
}
