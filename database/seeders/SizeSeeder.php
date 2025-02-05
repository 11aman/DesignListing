<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    public function run()
    {
        $sizes = [
            ['size_feet' => '6x4', 'size_mm' => '1800x1200'],
            ['size_feet' => '8x4', 'size_mm' => '2400x1200'],
            ['size_feet' => '10x5', 'size_mm' => '3000x1500'],
            ['size_feet' => '12x6', 'size_mm' => '3600x1800'],
            ['size_feet' => '14x7', 'size_mm' => '4200x2100'],
            ['size_feet' => '16x8', 'size_mm' => '4800x2400'],
            ['size_feet' => '18x9', 'size_mm' => '5400x2700'],
            ['size_feet' => '20x10', 'size_mm' => '6000x3000'],
            ['size_feet' => '22x11', 'size_mm' => '6600x3300'],
            ['size_feet' => '24x12', 'size_mm' => '7200x3600'],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}
