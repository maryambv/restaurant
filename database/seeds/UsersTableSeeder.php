<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => 2,
            'credit' => 0,
            'created_at' => '2017-04-29 15:00:55',
            'updated_at' => '2017-04-30 15:00:55',
        ]);
    }
}
