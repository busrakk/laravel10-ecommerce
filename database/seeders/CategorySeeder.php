<?php

namespace Database\Seeders;

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
        $women = Category::create([
            'image' => null,
            'thumbnail' => null,
            'cat_ust' => null,
            'name' => 'Women',
            'content' => 'Women Product',
            'status' => '1'
        ]);
        Category::create([
            'image' => null,
            'thumbnail' => null,
            'cat_ust' => $women->id,
            'name' => 'Women Jean',
            'content' => 'Women Jean Product',
            'status' => '1'
        ]);
        $men = Category::create([
            'image' => null,
            'thumbnail' => null,
            'cat_ust' => null,
            'name' => 'Men',
            'content' => 'Men Product',
            'status' => '1'
        ]);
        Category::create([
            'image' => null,
            'thumbnail' => null,
            'cat_ust' => $men->id,
            'name' => 'Men Jean',
            'content' => 'Men Jean Product',
            'status' => '1'
        ]);
        $children = Category::create([
            'image' => null,
            'thumbnail' => null,
            'cat_ust' => null,
            'name' => 'Children',
            'content' => 'Children Product',
            'status' => '1'
        ]);
        Category::create([
            'image' => null,
            'thumbnail' => null,
            'cat_ust' => $children->id,
            'name' => 'Children Jean',
            'content' => 'Children Jean Product',
            'status' => '1'
        ]);
    }
}
