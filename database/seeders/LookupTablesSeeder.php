<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\DesignCategory;
use App\Models\Species;
use App\Models\Structure;
use Illuminate\Database\Seeder;

class LookupTablesSeeder extends Seeder
{
    public function run()
    {
        // Design Categories
        $categories = ['Traditional', 'Contemporary', 'Modern', 'Rustic', 'Minimalist', 'Industrial', 'Bohemian', 'Scandinavian', 'Art Deco', 'Vintage'];
        foreach ($categories as $category) {
            DesignCategory::create(['name' => $category]);
        }

        // Species
        $speciesList = ['Oak', 'Walnut', 'Maple', 'Pine', 'Birch', 'Cherry', 'Mahogany', 'Teak', 'Ash', 'Hickory'];
        foreach ($speciesList as $species) {
            Species::create(['name' => $species]);
        }

        // Colors
        $colors = ['Light Brown', 'Dark Brown', 'Beige', 'Grey', 'Black', 'White', 'Red', 'Blue', 'Green', 'Yellow'];
        foreach ($colors as $color) {
            Color::create(['name' => $color]);
        }

        // Structures
        $structures = ['Herringbone', 'Chevron', 'Plank', 'Parquet', 'Mosaic', 'Strip', 'Basket Weave', 'Versailles', 'Hexagonal', 'Diagonal'];
        foreach ($structures as $structure) {
            Structure::create(['name' => $structure]);
        }
    }
}
