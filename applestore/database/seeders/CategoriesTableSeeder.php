<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 6; $i++)
            DB::table('categories')->insert([
                'title' => 'Category '.$i,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel aliquet nisl, ac suscipit diam. Suspendisse ac blandit elit',
                'img' => 'avds_xl.jpg',
                'alias' => 'category'.$i,
            ]);
    }
}
