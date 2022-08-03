<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 4; $i++) {
            DB::table('galleries')->insert([
                'img' => 'home_slider_1.jpg',
                'title' => 'Product '.$i,
                'desc' => 'fwefwefwefwefw',
            ]);
        }
    }
}
