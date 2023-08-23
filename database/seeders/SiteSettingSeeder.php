<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'name' => 'address',
            'data' => "The address of the site is here"
        ]);

        SiteSetting::create([
            'name' => 'phone',
            'data' => "0 123 456"
        ]);

        SiteSetting::create([
            'name' => 'email',
            'data' => "shoppers@domain.com"
        ]);

        SiteSetting::create([
            'name' => 'map',
            'data' => null
        ]);
    }
}
