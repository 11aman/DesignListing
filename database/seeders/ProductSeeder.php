<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Fetch existing categories
        $categories = ProductCategory::pluck('id', 'name');

        // Ensure required categories exist
        if (!isset($categories['Wood'], $categories['Vinyl'], $categories['Laminate'], $categories['Engineered Wood'])) {
            dd('One or more product categories are missing. Please run ProductCategorySeeder first.');
        }

        // Default subcategory if missing
        $defaultSubCategory = ProductCategory::whereNotNull('parent_id')->first()->id ?? null;

        // Seeding products
        Product::insert([
            [
                'name' => 'Oak Classic Floor',
                'product_category_id' => $categories['Wood'],
                'sub_category_id' => $categories['Laminate'] ?? $defaultSubCategory,
                'finish_id' => 1, 'size_id' => 1, 'structure_id' => 1,
                'design_category_id' => 1, 'species_id' => 1, 'color_id' => 1
            ],
            [
                'name' => 'Walnut Contemporary Floor',
                'product_category_id' => $categories['Wood'],
                'sub_category_id' => $categories['Engineered Wood'] ?? $defaultSubCategory,
                'finish_id' => 2, 'size_id' => 2, 'structure_id' => 2,
                'design_category_id' => 2, 'species_id' => 2, 'color_id' => 2
            ],
            [
                'name' => 'Pinewood Rustic',
                'product_category_id' => $categories['Wood'],
                'sub_category_id' => $categories['Engineered Wood'] ?? $defaultSubCategory,
                'finish_id' => 3, 'size_id' => 3, 'structure_id' => 1,
                'design_category_id' => 2, 'species_id' => 3, 'color_id' => 3
            ],
            [
                'name' => 'Luxury Vinyl Oak',
                'product_category_id' => $categories['Vinyl'],
                'sub_category_id' => $categories['Luxury Vinyl'] ?? $defaultSubCategory,
                'finish_id' => 5, 'size_id' => 4, 'structure_id' => 2,
                'design_category_id' => 1, 'species_id' => 4, 'color_id' => 4
            ]
        ]);
    }
}
