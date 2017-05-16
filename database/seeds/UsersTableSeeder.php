<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

require_once 'vendor/autoload.php';


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Factory::create('en_US');
        DB::table('users')->insert([
            'name' => $faker->firstName('female'),
            'email' => $faker->email,
            'password' => bcrypt('secret'),
            'role_id' => 2,
            'credit' => 0,
            'created_at' => $faker->dateTime,
            'updated_at' => '2017-04-30 15:00:55',
        ]);
    }
}
