<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlayerServer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_server', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->enum('player_id_type', ['steam', 'discord']);
            $table->unsignedBigInteger('server_id');
            $table->timestamps();

            $table->unique(['player_id', 'player_id_type', 'server_id'], 'id');

            $table->foreign(['player_id', 'player_id_type'])->references(['id', 'id_type'])->on('players')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_server');
    }
}
