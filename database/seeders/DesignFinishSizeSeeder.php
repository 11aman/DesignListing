<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignFinishSizeSeeder extends Seeder
{
    public function run()
    {
        $entries = [];
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 10; $j++) {
                for ($k = 1; $k <= 10; $k++) {
                    $entries[] = [
                        'design_id' => $i,
                        'finish_id' => $j,
                        'size_id' => $k,
                    ];
                }
            }
        }

        DB::table('design_finish_size')->insert($entries);
    }
}
