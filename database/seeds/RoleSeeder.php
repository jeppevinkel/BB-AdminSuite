<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create(array('name' => 'owner', 'permissions' => 16777215));
        \App\Role::create(array('name' => 'admin', 'permissions' => 11));
        \App\Role::create(array('name' => 'moderator', 'permissions' => 9));
        \App\Role::create(array('name' => 'user', 'permissions' => 1));
    }
}
