<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'code'=>'001',
            'image'=> 'images/men.png',
            'name'=>'Men',
        ]);

        Category::create([
            'code'=>'002',
            'image'=> 'images/women.png',
            'name'=>'Women',
        ]);

        Category::create([
            'code'=>'003',
            'image'=> 'images/kids.png',
            'name'=>'Kids',
        ]);

    }
}
