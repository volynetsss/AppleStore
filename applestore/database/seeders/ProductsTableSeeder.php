<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 11; $i++)
            DB::table('products')->insert([
                'title' => 'Product '.$i,
                'price' => rand(200,1500),
                'in_stock' => 1,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel aliquet nisl, ac suscipit diam. Suspendisse ac blandit elit. Suspendisse at lacus ut erat aliquam iaculis. Cras sollicitudin tellus ac ipsum consectetur sollicitudin. Sed maximus, tellus et faucibus imperdiet, neque purus imperdiet tellus, id dignissim diam lacus id risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus sollicitudin imperdiet orci vitae hendrerit. Nam faucibus mollis condimentum. ',
                'alias' =>'product'.$i,
            ]);
    }
}
