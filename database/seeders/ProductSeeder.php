<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Product 1',
            'image' => 'images/cloth_1.jpg',
            'category_id' =>1,
            'short_text' => 'short information',
            'price' => 100,
            'size' => 'Small',
            'color' => 'White',
            'qty' => 10,
            'status' => '1',
            'content' => '<p>This product is very good.</p>'
        ]);

        Product::create([
            'name' => 'Product 2',
            'image' => 'images/cloth_2.jpg',
            'category_id' =>2,
            'short_text' => 'short information 2',
            'price' => 120,
            'size' => 'Small',
            'color' => 'White',
            'qty' => 2,
            'status' => '1',
            'content' => '<p>This product is very good.</p>'
        ]);
    }
}
