<?php

use App\Food;
use Illuminate\Database\Seeder;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foods = [];
        for ($x = 0; $x < 5; $x++) {
            $foods[$x] = [
                'name' => str_random(10),
                'category_id' => 2,
                'price' => 10,
                'created_at' => '2017-04-29 15:00:55',
                'updated_at' => '2017-04-30 15:00:55',
            ];
        }

        foreach ($foods as $food) {
            Food::insert($food);
        }

    }
}
