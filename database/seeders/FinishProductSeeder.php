<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinishProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('finish_product_category')->insert([
            ['finish_id' => 1, 'product_category_id' => 1], // Glossy -> Wood
            ['finish_id' => 1, 'product_category_id' => 2], // Glossy -> Laminate
            ['finish_id' => 2, 'product_category_id' => 1], // Matte -> Wood
            ['finish_id' => 2, 'product_category_id' => 3], // Matte -> Vinyl
            ['finish_id' => 3, 'product_category_id' => 1], // Textured -> Wood
            ['finish_id' => 3, 'product_category_id' => 2], // Textured -> Laminate
            ['finish_id' => 3, 'product_category_id' => 3], // Textured -> Vinyl
            ['finish_id' => 4, 'product_category_id' => 2], // Satin -> Laminate
            ['finish_id' => 5, 'product_category_id' => 3], // Embossed -> Vinyl
            ['finish_id' => 6, 'product_category_id' => 1], // Semi-Matte -> Wood
        ]);
    }
}
