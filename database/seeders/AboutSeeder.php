<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
        "name" => "Shoppers Ecommerce",
        "content" => "About us article here",
        "text_1_icon" => "icon-truck",
        "text_1" => "FREE SHIPPING",
        "text_1_content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.",
        "text_2_icon" => "icon-refresh2",
        "text_2" => "FREE RETURNS",
        "text_2_content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.",
        "text_3_icon" => "icon-help",
        "text_3" => "CUSTOMER SUPPORT",
        "text_3_content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.",
        ]);
    }
}
