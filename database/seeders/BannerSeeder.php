<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('banners')->insert([
            [
                'heading_text' => 'Essential Basics',
                'sub_heading_text' => 'UP TO 30% OFF',
                'image' => 'upload/banner/collection-39.jpg',
                'link' => 'shop-collection-sub.html',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'heading_text' => 'Athleisure Wear',
                'sub_heading_text' => 'UP TO 40% OFF',
                'image' => 'upload/banner/collection-40.jpg',
                'link' => 'shop-collection-sub.html',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'heading_text' => 'Seasonal Favorites',
                'sub_heading_text' => 'HOT DEALS',
                'image' => 'upload/banner/collection-41.jpg',
                'link' => 'shop-collection-sub.html',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
