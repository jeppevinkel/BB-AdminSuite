<?php

use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Player::create(array(
            'id' => 2312345314,
            'id_type' => 'steam',
            'username' => 'Jopo',
        ));
    }
}
