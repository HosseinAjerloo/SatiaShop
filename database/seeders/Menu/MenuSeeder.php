<?php

namespace Database\Seeders\Menu;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu ;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Menu::MenuRecord as $menu)
        {
            Menu::create($menu);
        }
    }
}
