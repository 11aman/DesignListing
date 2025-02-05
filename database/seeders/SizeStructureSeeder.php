<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeStructureSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('size_structure')->insert([
            ['size_id' => 1, 'structure_id' => 1], // 6x4 -> Herringbone
            ['size_id' => 1, 'structure_id' => 2], // 6x4 -> Chevron
            ['size_id' => 2, 'structure_id' => 1], // 8x4 -> Herringbone
            ['size_id' => 2, 'structure_id' => 2], // 8x4 -> Chevron
            ['size_id' => 3, 'structure_id' => 3], // 10x4 -> Parquet
            ['size_id' => 3, 'structure_id' => 4], // 10x4 -> Straight
            ['size_id' => 4, 'structure_id' => 1], // 12x4 -> Herringbone
            ['size_id' => 4, 'structure_id' => 2], // 12x4 -> Chevron
            ['size_id' => 5, 'structure_id' => 5], // 14x4 -> Diagonal
            ['size_id' => 5, 'structure_id' => 1], // 14x4 -> Herringbone
        ]);
    }
}
