<?php

use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Server::create(array(
            'ip' => '192.168.0.1',
            'port' => '7777',
            'info' => 'some bunch of base64 shit',
            'pastebin' => 'g3HD42s',
            'status' => 'online',
            'cur_players' => 3,
            'max_players' => 24,
            'server_version' => '9.1.3',
            'exiled_version' => '1.9.3',
            'options' => 0,
        ));
    }
}
