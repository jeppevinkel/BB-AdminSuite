<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(array('username' => 'jopo', 'email' => 'jopo@jopo.com', 'password' => 'password'));
    }
}
