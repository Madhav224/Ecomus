<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing categories if needed (optional - uncomment if you want to start fresh)
        // Categorie::truncate();

        // First create parent categories
        $parentCategories = [
            [
                'name' => 'Men\'s Fashion',
                'description' => 'Discover the latest trends in men\'s clothing, from casual wear to formal attire.',
            ],
            [
                'name' => 'Women\'s Fashion', 
                'description' => 'Explore elegant and trendy women\'s clothing collection for every occasion.',
            ],
            [
                'name' => 'Kids & Baby',
                'description' => 'Adorable and comfortable clothing for children of all ages.',
            ],
            [
                'name' => 'Shoes & Accessories',
                'description' => 'Complete your look with our wide range of footwear and fashion accessories.',
            ],
        ];

        $createdParents = [];
        foreach ($parentCategories as $categoryData) {
            $category = Categorie::updateOrCreate(
                ['categorie_slug' => Str::slug($categoryData['name'])], // Find by slug
                [
                    'categorie_name' => $categoryData['name'],
                    'categorie_description' => $categoryData['description'],
                    'categorie_parent_id' => null,
                ]
            );

            $createdParents[$categoryData['name']] = $category;
            $this->createCategoryImages($category, $categoryData['name']);
        }

        // Then create child categories
        $childCategories = [
            [
                'name' => 'Casual Shirts',
                'description' => 'Comfortable casual shirts for everyday wear.',
                'parent' => 'Men\'s Fashion',
            ],
            [
                'name' => 'Formal Wear',
                'description' => 'Professional and elegant formal clothing.',
                'parent' => 'Men\'s Fashion',
            ],
            [
                'name' => 'Dresses',
                'description' => 'Beautiful dresses for every occasion and season.',
                'parent' => 'Women\'s Fashion',
            ],
            [
                'name' => 'Ethnic Wear',
                'description' => 'Traditional and ethnic clothing with modern touches.',
                'parent' => 'Women\'s Fashion',
            ],
        ];

        foreach ($childCategories as $categoryData) {
            $category = Categorie::updateOrCreate(
                ['categorie_slug' => Str::slug($categoryData['name'])], // Find by slug
                [
                    'categorie_name' => $categoryData['name'],
                    'categorie_description' => $categoryData['description'],
                    'categorie_parent_id' => $createdParents[$categoryData['parent']]->id,
                ]
            );

            $this->createCategoryImages($category, $categoryData['name']);
        }
    }

    private function createCategoryImages($category, $categoryName)
    {

        // Define image paths based on category
        $imageMap = [
            'Men\'s Fashion' => 'collection-circle-1.jpg',
            'Women\'s Fashion' => 'collection-circle-2.jpg', 
            'Kids & Baby' => 'collection-circle-3.jpg',
            'Shoes & Accessories' => 'collection-circle-4.jpg',
            'Casual Shirts' => 'collection-circle-5.jpg',
            'Formal Wear' => 'collection-circle-6.jpg',
            'Dresses' => 'collection-circle-2.jpg', // Using women's fashion image for subcategory
            'Ethnic Wear' => 'collection-circle-2.jpg', // Using women's fashion image for subcategory
        ];
        
        $imageName = $imageMap[$categoryName] ?? 'collection-circle-1.jpg';
        $bannerImage = 'upload/categories/' . $imageName;
        $desktopImage = 'upload/categories/' . $imageName;
        $mobileImage = 'upload/categories/' . $imageName;

        // Create banner image
        $category->images()->create([
            'categorie_image_type' => 'banner',
            'categorie_image_path' => json_encode([$bannerImage]),
        ]);

        // Create desktop image
        $category->images()->create([
            'categorie_image_type' => 'desktop', 
            'categorie_image_path' => json_encode([$desktopImage]),
        ]);

        // Create mobile image
        $category->images()->create([
            'categorie_image_type' => 'mobile',
            'categorie_image_path' => json_encode([$mobileImage]),
        ]);
    }
}