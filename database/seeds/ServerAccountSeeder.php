<?php

use Illuminate\Database\Seeder;

class ServerAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ServerAccount::class, 4)->create();
    }
}
