<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $blogs = [
            [
                'title' => 'Top 10 Summer Fashion Trends 2025',
                'description' => 'From oversized shirts to bold colors, discover the hottest fashion looks this summer.',
                'image' => 'upload/blog/fashion1.jpg',
                
                'status' => 'active',
            ],
            [
                'title' => 'How to Style Denim for Every Occasion',
                'description' => 'Tips on rocking denim whether you’re at work, a party, or just a casual outing.',
                'image' => 'upload/blog/fashion2.jpg',
                
                'status' => 'active',
            ],
            [
                'title' => 'Sustainable Fashion: A Complete Guide',
                'description' => 'Learn how eco-friendly clothing is changing the future of fashion.',
                'image' => 'upload/blog/fashion3.jpg',
                
                'status' => 'active',
            ],
            [
                'title' => 'The Comeback of Vintage Styles',
                'description' => 'Why retro-inspired outfits are trending again in 2025.',
                'image' => 'upload/blog/fashion4.jpg',
                
                'status' => 'active',
            ],
            [
                'title' => 'Essential Wardrobe Staples Every Woman Needs',
                'description' => 'Timeless pieces that should always be in your closet.',
                'image' => 'upload/blog/fashion5.jpg',
                
                'status' => 'active',
            ],
            [
                'title' => 'Streetwear Styles That Rule This Year',
                'description' => 'Explore how streetwear continues to influence high fashion.',
                'image' => 'upload/blog/fashion6.jpg',
                
                'status' => 'active',
            ],
            [
                'title' => 'Winter Outfit Ideas to Stay Warm & Stylish',
                'description' => 'From layering to chic coats, here’s how to slay the winter look.',
                'image' => 'upload/blog/fashion7.jpg',
                
                'status' => 'active',
            ],
            [
                'title' => 'The Rise of Minimalist Fashion',
                'description' => 'Why simplicity is becoming the new luxury in 2025 fashion.',
                'image' => 'upload/blog/fashion8.jpg',
               
                'status' => 'active',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
