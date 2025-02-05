<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Wood', 'parent_id' => null],
            ['name' => 'Vinyl', 'parent_id' => null],
            ['name' => 'Laminate', 'parent_id' => 1],
            ['name' => 'Engineered Wood', 'parent_id' => 1],
            ['name' => 'High Gloss Laminate', 'parent_id' => 3],
            ['name' => 'Matte Finish Laminate', 'parent_id' => 3],
            ['name' => 'Luxury Vinyl', 'parent_id' => 2],
            ['name' => 'Rigid Vinyl', 'parent_id' => 2],
            ['name' => 'Waterproof Vinyl', 'parent_id' => 2],
            ['name' => 'Stone Polymer Composite', 'parent_id' => 2]
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
