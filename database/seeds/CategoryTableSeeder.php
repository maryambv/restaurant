<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database category seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [['name' => 'Fastfood'], ['name' => 'Seefood'], ['name' => 'Mix'], ['name' => 'Italian']];
        foreach ($category as $category) {
            Category::insert($category);
        }
    }
}
