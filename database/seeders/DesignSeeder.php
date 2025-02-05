<?php

namespace Database\Seeders;

use App\Models\Design;
use Illuminate\Database\Seeder;

class DesignSeeder extends Seeder
{
    public function run()
    {
        $designs = [
            ['name' => 'Classic Oak', 'design_category_id' => 1, 'species_id' => 1, 'color_id' => 1, 'structure_id' => 1],
            ['name' => 'Modern Walnut', 'design_category_id' => 2, 'species_id' => 2, 'color_id' => 2, 'structure_id' => 2],
            ['name' => 'Rustic Pine', 'design_category_id' => 3, 'species_id' => 3, 'color_id' => 3, 'structure_id' => 3],
            ['name' => 'Minimalist Maple', 'design_category_id' => 4, 'species_id' => 4, 'color_id' => 4, 'structure_id' => 4],
            ['name' => 'Industrial Birch', 'design_category_id' => 5, 'species_id' => 5, 'color_id' => 5, 'structure_id' => 5],
            ['name' => 'Bohemian Cherry', 'design_category_id' => 6, 'species_id' => 6, 'color_id' => 6, 'structure_id' => 6],
            ['name' => 'Scandinavian Teak', 'design_category_id' => 7, 'species_id' => 7, 'color_id' => 7, 'structure_id' => 7],
            ['name' => 'Art Deco Ash', 'design_category_id' => 8, 'species_id' => 8, 'color_id' => 8, 'structure_id' => 8],
            ['name' => 'Vintage Hickory', 'design_category_id' => 9, 'species_id' => 9, 'color_id' => 9, 'structure_id' => 9],
            ['name' => 'Contemporary Beech', 'design_category_id' => 10, 'species_id' => 10, 'color_id' => 10, 'structure_id' => 10],
        ];

        foreach ($designs as $design) {
            Design::create($design);
        }
    }
}
