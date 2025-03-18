<?php

namespace Inovector\ProductManager\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Gaming Laptops',
                'slug' => 'gaming-laptops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Laptops',
                'slug' => 'business-laptops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2-in-1 Laptops',
                'slug' => '2-in-1-laptops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ultrabooks',
                'slug' => 'ultrabooks',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budget Laptops',
                'slug' => 'budget-laptops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}