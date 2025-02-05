<?php

namespace Database\Seeders;

use App\Models\Finish;
use Illuminate\Database\Seeder;

class FinishSeeder extends Seeder
{
    public function run()
    {
        $finishes = ['Glossy', 'Matte', 'Textured', 'Satin', 'Semi-Gloss', 'Brushed', 'Polished', 'Handscraped', 'Distressed', 'Oil Finish'];
        foreach ($finishes as $finish) {
            Finish::create(['name' => $finish]);
        }
    }
}
