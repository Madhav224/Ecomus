<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          Slider::insert([
            [
                'heading_text' => 'Welcome to Our Store',
                'sub_heading_text' => 'Best products at the best prices',
                'image' => 'upload/slider/slide1.jpg', // put an image in public/upload/slider/
                'link_type' => 'link',
                'link' => 'https://example.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'heading_text' => 'Summer Collection',
                'sub_heading_text' => 'Cool deals for hot days',
                'image' => 'upload/slider/slide2.jpg',
                'link_type' => 'category',
                'link' => 'summer-collection',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'heading_text' => 'New Arrivals',
                'sub_heading_text' => 'Check out the latest trends',
                'image' => 'upload/slider/slide3.jpg',
                'link_type' => 'product',
                'link' => 'new-product-slug',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
