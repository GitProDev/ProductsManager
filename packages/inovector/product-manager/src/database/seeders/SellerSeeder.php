<?php

namespace Inovector\ProductManager\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellerSeeder extends Seeder
{
    public function run()
    {
        DB::table('sellers')->insert([
            [
                'name' => 'HP',
                'logo_url' => 'https://example.com/hp-logo.png',
                'website_url' => 'https://www.hp.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell',
                'logo_url' => 'https://example.com/dell-logo.png',
                'website_url' => 'https://www.dell.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lenovo',
                'logo_url' => 'https://example.com/lenovo-logo.png',
                'website_url' => 'https://www.lenovo.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}