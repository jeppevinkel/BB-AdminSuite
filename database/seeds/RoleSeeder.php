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
        \App\Role::create(array('name' => 'admin', 'server_account_id' => 1, 'permissions' => 14));
        \App\Role::create(array('name' => 'moderator', 'server_account_id' => 1, 'permissions' => 8));
        \App\Role::create(array('name' => 'user', 'server_account_id' => 1, 'permissions' => 3));
        \App\Role::create(array('name' => 'admin', 'server_account_id' => 2, 'permissions' => 14));
        \App\Role::create(array('name' => 'moderator', 'server_account_id' => 2, 'permissions' => 8));
        \App\Role::create(array('name' => 'user', 'server_account_id' => 2, 'permissions' => 3));
        \App\Role::create(array('name' => 'admin', 'server_account_id' => 3, 'permissions' => 14));
        \App\Role::create(array('name' => 'moderator', 'server_account_id' => 3, 'permissions' => 8));
        \App\Role::create(array('name' => 'user', 'server_account_id' => 3, 'permissions' => 3));
        \App\Role::create(array('name' => 'admin', 'server_account_id' => 4, 'permissions' => 14));
        \App\Role::create(array('name' => 'moderator', 'server_account_id' => 4, 'permissions' => 8));
        \App\Role::create(array('name' => 'user', 'server_account_id' => 4, 'permissions' => 3));
    }
}
