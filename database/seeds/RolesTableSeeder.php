<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database  role seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [['name' => 'Administrator'], ['name' => 'Client']];
        foreach ($roles as $role) {
            Role::insert($role);
        }
    }
}
