<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Bank\BankSeeder;
use Database\Seeders\Brand\BrandSeeder;
use Database\Seeders\Category\CategorySeeder;
use Database\Seeders\Menu\MenuSeeder;
use Database\Seeders\Product\ProductSeeder;
use Database\Seeders\Setting\SettingSeeder;
use Database\Seeders\Supllier\Supplier ;
use Database\Seeders\SupplierCategorie\SupplierCategorie;
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
            UserSeeder::class,
            SupplierCategorie::class,
            Supplier::class,
            MenuSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class
        ]);
    }
}
