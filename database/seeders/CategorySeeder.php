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
            'name'=>'Men',
        ]);

        Category::create([
            'code'=>'002',
            'name'=>'Women',
        ]);

        Category::create([
            'code'=>'003',
            'name'=>'Kids',
        ]);

    }
}
