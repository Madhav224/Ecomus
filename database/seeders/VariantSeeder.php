<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Variant;

class VariantSeeder extends Seeder
{
   
         public function run(): void
    {
        // Create parent variants (main variant types)
        $parentVariants = [
            [
                'name' => 'color',
                'is_color' => '1',
                'value' => null, // Parent variants don't need values
            ],
            [
                'name' => 'size',
                'is_color' => '0',
                'value' => null,
            ],
            [
                'name' => 'material',
                'is_color' => '0',
                'value' => null,
            ],
        ];

        $createdParents = [];
        foreach ($parentVariants as $parentData) {
            echo "Creating parent variant: " . $parentData['name'] . "\n";
            
            $variant = Variant::updateOrCreate(
                ['variant_name' => $parentData['name'], 'variant_parent_id' => null],
                [
                    'variant_value' => $parentData['value'],
                    'is_color' => $parentData['is_color'],
                ]
            );
            
            $createdParents[$parentData['name']] = $variant;
            echo "Parent variant created with ID: " . $variant->id . "\n";
        }

        // Create child variants (specific variant options)
        $childVariants = [
            // Color variants
            [
                'name' => 'black',
                'parent' => 'color',
                'value' => '#000000',
            ],
            [
                'name' => 'white',
                'parent' => 'color',
                'value' => '#FFFFFF',
            ],
            [
                'name' => 'red',
                'parent' => 'color',
                'value' => '#FF0000',
            ],
            [
                'name' => 'blue',
                'parent' => 'color',
                'value' => '#0066CC',
            ],
            [
                'name' => 'green',
                'parent' => 'color',
                'value' => '#00CC66',
            ],
            [
                'name' => 'navy',
                'parent' => 'color',
                'value' => '#000080',
            ],
            [
                'name' => 'gray',
                'parent' => 'color',
                'value' => '#808080',
            ],
            [
                'name' => 'pink',
                'parent' => 'color',
                'value' => '#FF69B4',
            ],
            
            // Size variants
            [
                'name' => 'xs',
                'parent' => 'size',
                'value' => 'XS',
            ],
            [
                'name' => 's',
                'parent' => 'size',
                'value' => 'S',
            ],
            [
                'name' => 'm',
                'parent' => 'size',
                'value' => 'M',
            ],
            [
                'name' => 'l',
                'parent' => 'size',
                'value' => 'L',
            ],
            [
                'name' => 'xl',
                'parent' => 'size',
                'value' => 'XL',
            ],
            [
                'name' => 'xxl',
                'parent' => 'size',
                'value' => 'XXL',
            ],
            
            // Material variants
            [
                'name' => 'cotton',
                'parent' => 'material',
                'value' => 'Cotton',
            ],
            [
                'name' => 'polyester',
                'parent' => 'material',
                'value' => 'Polyester',
            ],
            [
                'name' => 'wool',
                'parent' => 'material',
                'value' => 'Wool',
            ],
            [
                'name' => 'silk',
                'parent' => 'material',
                'value' => 'Silk',
            ],
            [
                'name' => 'denim',
                'parent' => 'material',
                'value' => 'Denim',
            ],
            [
                'name' => 'leather',
                'parent' => 'material',
                'value' => 'Leather',
            ],
        ];

        foreach ($childVariants as $childData) {
            echo "Creating child variant: " . $childData['name'] . "\n";
            
            $parentVariant = $createdParents[$childData['parent']];
            
            $variant = Variant::updateOrCreate(
                [
                    'variant_name' => $childData['name'], 
                    'variant_parent_id' => $parentVariant->id
                ],
                [
                    'variant_value' => $childData['value'],
                    'is_color' => $parentVariant->is_color, // Inherit from parent
                ]
            );
            
            echo "Child variant created with ID: " . $variant->id . "\n";
        }

        echo "Variant seeder completed successfully!\n";
        echo "Created " . count($parentVariants) . " parent variants\n";
        echo "Created " . count($childVariants) . " child variants\n";
    }
    
}
