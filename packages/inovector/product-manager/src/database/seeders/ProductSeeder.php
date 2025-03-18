<?php

namespace Inovector\ProductManager\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Dummy product data
        $products = [
            // HP products
            ['seller_id' => 1, 'category_id' => 1, 'name' => 'HP Omen 15 Gaming Laptop', 'price' => 1500.00, 'stock_status' => 'in_stock', 'average_rating' => 4.5, 'product_url' => 'https://www.hp.com/omen15'],
            ['seller_id' => 1, 'category_id' => 2, 'name' => 'HP Elite Dragonfly Business Laptop', 'price' => 1700.00, 'stock_status' => 'in_stock', 'average_rating' => 4.7, 'product_url' => 'https://www.hp.com/elite-dragonfly'],
            ['seller_id' => 1, 'category_id' => 3, 'name' => 'HP Spectre x360 2-in-1 Laptop', 'price' => 1300.00, 'stock_status' => 'out_of_stock', 'average_rating' => 4.6, 'product_url' => 'https://www.hp.com/spectre-x360'],
            ['seller_id' => 1, 'category_id' => 4, 'name' => 'HP Envy Ultrabook', 'price' => 1200.00, 'stock_status' => 'in_stock', 'average_rating' => 4.8, 'product_url' => 'https://www.hp.com/envy-ultrabook'],
            ['seller_id' => 1, 'category_id' => 5, 'name' => 'HP Pavilion 14 Budget Laptop', 'price' => 600.00, 'stock_status' => 'in_stock', 'average_rating' => 4.3, 'product_url' => 'https://www.hp.com/pavilion-14'],

            // Dell products
            ['seller_id' => 2, 'category_id' => 1, 'name' => 'Dell Alienware m15 Gaming Laptop', 'price' => 1800.00, 'stock_status' => 'in_stock', 'average_rating' => 4.6, 'product_url' => 'https://www.dell.com/alienware-m15'],
            ['seller_id' => 2, 'category_id' => 2, 'name' => 'Dell Latitude 7420 Business Laptop', 'price' => 1400.00, 'stock_status' => 'out_of_stock', 'average_rating' => 4.4, 'product_url' => 'https://www.dell.com/latitude-7420'],
            ['seller_id' => 2, 'category_id' => 3, 'name' => 'Dell Inspiron 14 5000 2-in-1', 'price' => 850.00, 'stock_status' => 'in_stock', 'average_rating' => 4.2, 'product_url' => 'https://www.dell.com/inspiron-14'],
            ['seller_id' => 2, 'category_id' => 4, 'name' => 'Dell XPS 13 Ultrabook', 'price' => 1300.00, 'stock_status' => 'in_stock', 'average_rating' => 4.9, 'product_url' => 'https://www.dell.com/xps-13'],
            ['seller_id' => 2, 'category_id' => 5, 'name' => 'Dell Inspiron 15 Budget Laptop', 'price' => 700.00, 'stock_status' => 'in_stock', 'average_rating' => 4.0, 'product_url' => 'https://www.dell.com/inspiron-15'],

            // Lenovo products
            ['seller_id' => 3, 'category_id' => 1, 'name' => 'Lenovo Legion 5 Gaming Laptop', 'price' => 1600.00, 'stock_status' => 'in_stock', 'average_rating' => 4.5, 'product_url' => 'https://www.lenovo.com/legion-5'],
            ['seller_id' => 3, 'category_id' => 2, 'name' => 'Lenovo ThinkPad X1 Carbon Business Laptop', 'price' => 1800.00, 'stock_status' => 'in_stock', 'average_rating' => 4.8, 'product_url' => 'https://www.lenovo.com/thinkpad-x1'],
            ['seller_id' => 3, 'category_id' => 3, 'name' => 'Lenovo Yoga 7i 2-in-1 Laptop', 'price' => 1200.00, 'stock_status' => 'in_stock', 'average_rating' => 4.7, 'product_url' => 'https://www.lenovo.com/yoga-7i'],
            ['seller_id' => 3, 'category_id' => 4, 'name' => 'Lenovo ThinkPad X1 Nano Ultrabook', 'price' => 1400.00, 'stock_status' => 'out_of_stock', 'average_rating' => 4.9, 'product_url' => 'https://www.lenovo.com/thinkpad-x1-nano'],
            ['seller_id' => 3, 'category_id' => 5, 'name' => 'Lenovo Ideapad 3 Budget Laptop', 'price' => 500.00, 'stock_status' => 'in_stock', 'average_rating' => 4.1, 'product_url' => 'https://www.lenovo.com/ideapad-3'],
        ];

        // Inserting the products in bulk
        foreach ($products as $product) {
            DB::table('products')->insert([
                'seller_id' => $product['seller_id'],
                'category_id' => $product['category_id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'stock_status' => $product['stock_status'],
                'average_rating' => $product['average_rating'],
                'product_url' => $product['product_url'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}