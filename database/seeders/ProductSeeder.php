<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'code'=>'P000',
            'name'=>'Women Shirt',
            'price' => 260,
            'image'=> 'images/P000.png',
            'category_id'=> 2,
        ]);

        Product::create([
            'code'=>'P001',
            'name'=>'Men Pant',
            'price' => 300,
            'image'=> 'images/P001.jpg',
            'category_id'=> 1,
        ]);

        Product::create([
            'code'=>'P002',
            'name'=>'Kid Dress',
            'price' => 190,
            'image'=> 'images/P002.jpg',
            'category_id'=> 3,
        ]);

        Product::create([
            'code'=>'P003',
            'name'=>'Women Dress',
            'price' => 250,
            'image'=> 'images/P003.jpg',
            'category_id'=> 2,
        ]);

    }
}
