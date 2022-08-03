<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 4; $i++) {
            DB::table('features')->insert([
                'title' => 'icon_' . $i . '.svg',
                'desc' => 'fwefwefwfwe',
                'icon' => 'icon_'.$i,
            ]);
        }
    }
}
