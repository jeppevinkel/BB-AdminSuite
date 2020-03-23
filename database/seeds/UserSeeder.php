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
        \App\User::create(array('username' => 'jopo', 'email' => 'jeppevinkel@gmail.com', 'email_verified_at' => '2020-03-22 16:45:28', 'password' => '$2y$10$aP2h7EUrL8/Etocah81t2OtFq8GgHO4eaGLN0MkY6blBHMMFAm.ZK'));
    }
}
