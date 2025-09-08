<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create upload directory if it doesn't exist
        $directory = 'upload/brand';
        if (!File::exists(public_path($directory))) {
            File::makeDirectory(public_path($directory), 0755, true);
            echo "Created directory: " . public_path($directory) . "\n";
        }

        $brands = [
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'description' => 'Just Do It - Leading sportswear and athletic footwear brand',
                'path' => '/brands/nike',
                'image' => 'nike.png', // You can place actual brand logos here
            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas', 
                'description' => 'Impossible is Nothing - German multinational corporation that designs and manufactures shoes, clothing and accessories',
                'path' => '/brands/adidas',
                'image' => 'adidas.jpg',
            ],
            [
                'name' => 'Zara',
                'slug' => 'zara',
                'description' => 'Spanish fast fashion retailer known for trendy and affordable clothing',
                'path' => '/brands/zara',
                'image' => 'zara.png',
            ],
            [
                'name' => 'H&M',
                'slug' => 'hm',
                'description' => 'Swedish multinational clothing-retail company known for fast-fashion clothing',
                'path' => '/brands/hm',
                'image' => 'hm.jpg',
            ],
            [
                'name' => 'Levi\'s',
                'slug' => 'levis',
                'description' => 'American clothing company known worldwide for its Levi\'s brand of denim jeans',
                'path' => '/brands/levis',
                'image' => 'levis.png',
            ],
           
            [
                'name' => 'Calvin Klein',
                'slug' => 'calvin-klein',
                'description' => 'American fashion house specializing in leather, lifestyle accessories, home furnishings, perfumery, jewelry, watches and ready-to-wear',
                'path' => '/brands/calvinklein',
                'image' => 'calvinklein.png',
            ],
            [
                'name' => 'Puma',
                'slug' => 'puma',
                'description' => 'German multinational corporation that designs and manufactures athletic and casual footwear, apparel and accessories',
                'path' => '/brands/puma',
                'image' => 'puma.png',
            ],
           
        ];

        foreach ($brands as $brandData) {
            echo "Creating brand: " . $brandData['name'] . "\n";
            
            // Create a placeholder image path (you can replace with actual brand logos)
            $imagePath = $directory . '/' . $brandData['image'];
            
            // For demo purposes, we'll just set the image path
            // In real scenario, you would copy actual brand logo files to the directory
            
            $brand = Brand::updateOrCreate(
                ['brand_slug' => $brandData['slug']], // Find by slug to avoid duplicates
                [
                    'brand_name' => $brandData['name'],
                    'brand_description' => $brandData['description'],
                    'brand_path' => $brandData['path'],
                    'brand_image' => $imagePath, // This assumes you have brand logo images
                ]
            );
            
            echo "Brand created with ID: " . $brand->id . "\n";
        }

        echo "Brand seeder completed successfully!\n";
        echo "Created " . count($brands) . " brands\n";
        echo "\nNOTE: Please add actual brand logo images to public/" . $directory . "/ directory:\n";
        
        foreach ($brands as $brandData) {
            echo "- " . $brandData['image'] . "\n";
        }
    }
}