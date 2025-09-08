<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Categorie;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some categories and brands to assign to products
        $categories = Categorie::whereNotNull('categorie_parent_id')->take(5)->get(); // Get child categories
        $brands = Brand::take(4)->get();

        // Create upload directory if it doesn't exist
        $directory = 'upload/products';
        if (!File::exists(public_path($directory))) {
            File::makeDirectory(public_path($directory), 0755, true);
            echo "Created directory: " . public_path($directory) . "\n";
        }

        $products = [
            [
                'name' => 'Classic Denim Jacket',
                'slug' => 'classic-denim-jacket',
                'sku_code' => 'DNM-JKT-001',
                'short_description' => 'Timeless denim jacket with vintage wash and classic fit',
                'long_description' => 'A wardrobe essential that never goes out of style. This classic denim jacket features a comfortable regular fit, authentic vintage wash, and durable construction. Perfect for layering over t-shirts or hoodies for a casual, effortless look.',
                'details' => [
                    'Material' => '100% Cotton Denim',
                    'Fit' => 'Regular Fit',
                    'Wash' => 'Medium Blue',
                    'Closure' => 'Button Front',
                    'Care' => 'Machine Wash Cold'
                ],
                'additional_details' => [
                    'title' => ['Origin', 'Season', 'Style', 'Occasion'],
                    'value' => ['Made in India', 'All Season', 'Casual', 'Daily Wear']
                ],
                'images' => [
                    'denim_jacket_1.jpg',
                    'denim_jacket_2.jpg',
                    'denim_jacket_3.jpg'
                ],
                'thumbnail' => 'denim_jacket_thumb.jpg',
                'mrp' => 3999,
                'price' => 2999,
                'discount' => 25,
                'stock' => 50,
                'frequently_bought' => [], // Will be set after all products are created
                'has_variants' => true
            ],
            [
                'name' => 'Floral Midi Dress',
                'slug' => 'floral-midi-dress',
                'sku_code' => 'FLR-DRS-002',
                'short_description' => 'Elegant floral print midi dress perfect for summer occasions',
                'long_description' => 'This beautiful midi dress features a romantic floral print, flowing silhouette, and comfortable fit. Made from lightweight fabric, it\'s perfect for brunches, date nights, or any special occasion. The dress includes a tie waist for a flattering fit.',
                'details' => [
                    'Material' => 'Poly Crepe',
                    'Length' => 'Midi',
                    'Sleeves' => 'Three Quarter',
                    'Print' => 'Floral',
                    'Neckline' => 'V-Neck'
                ],
                'additional_details' => [
                    'title' => ['Lining', 'Closure', 'Fit', 'Care Instructions'],
                    'value' => ['Fully Lined', 'Side Zip', 'A-Line', 'Dry Clean Only']
                ],
                'images' => [
                    'floral_midi_dress_1.jpg',
                    'floral_midi_dress_2.jpg'
                ],
                'thumbnail' => 'floral_midi_dress_thumb.jpg',
                'mrp' => 4999,
                'price' => 3499,
                'discount' => 30,
                'stock' => 35,
                'frequently_bought' => [],
                'has_variants' => false
            ],
            [
                'name' => 'Premium Cotton T-Shirt',
                'slug' => 'premium-cotton-t-shirt',
                'sku_code' => 'CTN-TSH-003',
                'short_description' => 'Soft premium cotton t-shirt with perfect fit and comfort',
                'long_description' => 'Made from 100% premium cotton, this t-shirt offers exceptional comfort and durability. The classic crew neck design and regular fit make it perfect for everyday wear. Pre-shrunk fabric ensures the fit stays true wash after wash.',
                'details' => [
                    'Material' => '100% Premium Cotton',
                    'Fit' => 'Regular Fit',
                    'Neck' => 'Crew Neck',
                    'Sleeves' => 'Short Sleeves',
                    'GSM' => '180 GSM'
                ],
                'additional_details' => [
                    'title' => ['Pre-shrunk', 'Tagless', 'Seam', 'Thread Count'],
                    'value' => ['Yes', 'Comfort Fit', 'Double Needle', 'High Quality']
                ],
                'images' => [
                    'cotton_tshirt_1.jpg',
                    'cotton_tshirt_2.jpg',
                    'cotton_tshirt_3.jpg'
                ],
                'thumbnail' => 'cotton_tshirt_thumb.jpg',
                'mrp' => 999,
                'price' => 699,
                'discount' => 30,
                'stock' => 100,
                'frequently_bought' => [],
                'has_variants' => true
            ],
            [
                'name' => 'High-Waisted Skinny Jeans',
                'slug' => 'high-waisted-skinny-jeans',
                'sku_code' => 'HW-JNS-004',
                'short_description' => 'Flattering high-waisted skinny jeans with stretch comfort',
                'long_description' => 'These high-waisted skinny jeans are designed to hug your curves in all the right places. Made with stretch denim for comfort and movement, they feature a classic five-pocket design and are perfect for both casual and dressed-up looks.',
                'details' => [
                    'Material' => '98% Cotton, 2% Elastane',
                    'Rise' => 'High Rise',
                    'Fit' => 'Skinny',
                    'Length' => 'Full Length',
                    'Closure' => 'Zip Fly with Button'
                ],
                'additional_details' => [
                    'title' => ['Stretch', 'Pockets', 'Wash', 'Inseam'],
                    'value' => ['Yes', '5 Pocket Design', 'Dark Blue', '32 inches']
                ],
                'images' => [
                    'skinny_jeans_1.jpg',
                    'skinny_jeans_2.jpg'
                ],
                'thumbnail' => 'skinny_jeans_thumb.jpg',
                'mrp' => 2999,
                'price' => 1999,
                'discount' => 33,
                'stock' => 60,
                'frequently_bought' => [],
                'has_variants' => true
            ],
            [
                'name' => 'Leather Crossbody Bag',
                'slug' => 'leather-crossbody-bag',
                'sku_code' => 'LTH-BAG-005',
                'short_description' => 'Genuine leather crossbody bag with adjustable strap and multiple compartments',
                'long_description' => 'This elegant crossbody bag is crafted from genuine leather and features multiple compartments for organization. The adjustable strap allows for versatile styling, while the compact size makes it perfect for both day and evening looks.',
                'details' => [
                    'Material' => 'Genuine Leather',
                    'Closure' => 'Zip Closure',
                    'Strap' => 'Adjustable Crossbody',
                    'Compartments' => 'Multiple',
                    'Size' => '25cm x 18cm x 8cm'
                ],
                'additional_details' => [
                    'title' => ['Interior', 'Hardware', 'Pockets', 'Care'],
                    'value' => ['Fabric Lined', 'Gold Tone', '2 Interior, 1 Exterior', 'Leather Cleaner']
                ],
                'images' => [
                    'crossbody_bag_1.jpg',
                    'crossbody_bag_2.jpg',
                    'crossbody_bag_3.jpg'
                ],
                'thumbnail' => 'crossbody_bag_thumb.jpg',
                'mrp' => 8999,
                'price' => 6999,
                'discount' => 22,
                'stock' => 25,
                'frequently_bought' => [],
                'has_variants' => false
            ],
            [
                'name' => 'Casual Sneakers',
                'slug' => 'casual-sneakers',
                'sku_code' => 'SNK-CAS-006',
                'short_description' => 'Comfortable casual sneakers perfect for everyday wear',
                'long_description' => 'These versatile casual sneakers combine style and comfort for everyday wear. Featuring breathable mesh upper, cushioned sole, and durable rubber outsole. Perfect for walking, casual outings, or light workouts.',
                'details' => [
                    'Upper Material' => 'Mesh and Synthetic',
                    'Sole' => 'Rubber Outsole',
                    'Closure' => 'Lace-up',
                    'Cushioning' => 'Memory Foam',
                    'Weight' => 'Lightweight'
                ],
                'additional_details' => [
                    'title' => ['Breathability', 'Arch Support', 'Toe Style', 'Occasion'],
                    'value' => ['Mesh Ventilation', 'Yes', 'Round Toe', 'Casual, Sports']
                ],
                'images' => [
                    'casual_sneakers_1.jpg',
                    'casual_sneakers_2.jpg'
                ],
                'thumbnail' => 'casual_sneakers_thumb.jpg',
                'mrp' => 4999,
                'price' => 3999,
                'discount' => 20,
                'stock' => 40,
                'frequently_bought' => [],
                'has_variants' => true
            ]
        ];

        $createdProducts = [];

        foreach ($products as $index => $productData) {
            echo "Creating product: " . $productData['name'] . "\n";
            
            // Assign category and brand
            $category = $categories->get($index % $categories->count());
            $brand = $brands->get($index % $brands->count());
            
            // Prepare image paths
            $imagePaths = [];
            foreach ($productData['images'] as $image) {
                $imagePaths[] = $directory . '/' . $image;
            }
            
            $thumbnailPath = $directory . '/' . $productData['thumbnail'];
            
            // Get random categories for categorie_id array (your controller expects an array)
            $categoryIds = $categories->random(min(2, $categories->count()))->pluck('id')->toArray();
            
            $product = Product::updateOrCreate(
                ['product_slug' => $productData['slug']],
                [
                    'product_name' => $productData['name'],
                    'product_slug' => $productData['slug'], // Auto-generated in controller but we set it
                    'product_sku_code' => $productData['sku_code'],
                    'product_categorie_id' => $categoryIds, // Array as per your controller
                    'product_brand_id' => $brand ? $brand->id : null,
                    'product_short_description' => $productData['short_description'],
                    'product_long_description' => $productData['long_description'],
                    'product_details' => $productData['details'], // JSON field
                    'product_additional_details' => array_combine(
                        $productData['additional_details']['title'],
                        $productData['additional_details']['value']
                    ), // Combined as per controller logic
                    'product_thumbnail_image' => $thumbnailPath,
                    'product_images' => $imagePaths, // JSON array
                    'product_mrp' => $productData['mrp'],
                    'product_price' => $productData['price'],
                    'product_discount' => $productData['discount'],
                    'product_stock' => $productData['stock'],
                    'frequently_bought' => null, // Will update later (max 2 items as per validation)
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            
            $createdProducts[] = $product;
            
            echo "Product created with ID: " . $product->id . "\n";
            echo "Assigned to categories: " . implode(', ', $categoryIds) . "\n";
            echo "Assigned to brand: " . ($brand ? $brand->brand_name : 'None') . "\n";
            
            // Create variants if product has variants
            if ($productData['has_variants']) {
                $this->createVariants($product, $directory);
            }
            
            echo "\n";
        }

        // Update frequently_bought with actual product IDs
        $this->updateFrequentlyBought($createdProducts);

        echo "Product seeder completed successfully!\n";
        echo "Created " . count($products) . " products\n";
        echo "\nNOTE: Please add actual product images to public/" . $directory . "/ directory:\n";
        
        foreach ($products as $productData) {
            echo "- " . $productData['thumbnail'] . " (thumbnail)\n";
            foreach ($productData['images'] as $image) {
                echo "- " . $image . "\n";
            }
        }
        
        echo "\nVariant images will also be needed for products with variants.\n";
    }

    private function createVariants($product, $directory)
    {
        $variantData = [
            1 => [ // Denim Jacket
                [
                    'variant_combination' => ['Medium', 'Light Blue'],
                    'variant_ids' => [1, 5],
                    'product_variant_skucode' => 'denim-jacket-m-light',
                    'product_variant_youtube_link' => 'https://youtube.com/watch?v=styling-tips',
                    'product_variant_mrp' => 3999,
                    'product_variant_price' => 2999,
                    'product_variant_discount' => 25,
                    'product_variant_stock' => 15,
                    'product_variant_images' => [$directory . '/denim_jacket_m_light.jpg'],
                    'product_variant_thumbnail_image' => $directory . '/denim_jacket_m_light_thumb.jpg'
                ],
                [
                    'variant_combination' => ['Large', 'Dark Blue'],
                    'variant_ids' => [2, 6],
                    'product_variant_skucode' => 'denim-jacket-l-dark',
                    'product_variant_youtube_link' => null,
                    'product_variant_mrp' => 3999,
                    'product_variant_price' => 2999,
                    'product_variant_discount' => 25,
                    'product_variant_stock' => 20,
                    'product_variant_images' => [$directory . '/denim_jacket_l_dark.jpg'],
                    'product_variant_thumbnail_image' => $directory . '/denim_jacket_l_dark_thumb.jpg'
                ]
            ],
            3 => [ // Cotton T-Shirt
                [
                    'variant_combination' => ['Small', 'White'],
                    'variant_ids' => [7, 9],
                    'product_variant_skucode' => 'cotton-tshirt-s-white',
                    'product_variant_youtube_link' => null,
                    'product_variant_mrp' => 999,
                    'product_variant_price' => 699,
                    'product_variant_discount' => 30,
                    'product_variant_stock' => 25,
                    'product_variant_images' => [$directory . '/cotton_tshirt_s_white.jpg'],
                    'product_variant_thumbnail_image' => $directory . '/cotton_tshirt_s_white_thumb.jpg'
                ],
                [
                    'variant_combination' => ['Medium', 'Black'],
                    'variant_ids' => [8, 10],
                    'product_variant_skucode' => 'cotton-tshirt-m-black',
                    'product_variant_youtube_link' => null,
                    'product_variant_mrp' => 999,
                    'product_variant_price' => 699,
                    'product_variant_discount' => 30,
                    'product_variant_stock' => 30,
                    'product_variant_images' => [$directory . '/cotton_tshirt_m_black.jpg'],
                    'product_variant_thumbnail_image' => $directory . '/cotton_tshirt_m_black_thumb.jpg'
                ]
            ]
        ];

        $productIndex = null;
        switch ($product->product_slug) {
            case 'classic-denim-jacket':
                $productIndex = 1;
                break;
            case 'premium-cotton-t-shirt':
                $productIndex = 3;
                break;
            case 'high-waisted-skinny-jeans':
                $productIndex = 4;
                break;
            case 'casual-sneakers':
                $productIndex = 6;
                break;
        }

        if ($productIndex && isset($variantData[$productIndex])) {
            foreach ($variantData[$productIndex] as $variant) {
                $variant['product_id'] = $product->id;
                ProductVariant::create($variant);
                echo "Created variant: " . $variant['product_variant_skucode'] . "\n";
            }
        }
    }

    private function updateFrequentlyBought($products)
    {
        // Update frequently bought with actual product IDs (max 2 as per controller validation)
        foreach ($products as $index => $product) {
            $otherProductIds = collect($products)
                ->except($index)
                ->random(min(2, count($products) - 1)) // Max 2 as per validation rule
                ->pluck('id')
                ->toArray();
            
            $product->update(['frequently_bought' => $otherProductIds]);
        }
        
        echo "Updated frequently_bought relationships (max 2 items each)\n";
    }
}
