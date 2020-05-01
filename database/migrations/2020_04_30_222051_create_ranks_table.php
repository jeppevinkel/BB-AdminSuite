<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_account_id');
            $table->string('rank_name');
            $table->string('badge_color');
            $table->string('badge_text');
            $table->boolean('cover')->default(true);
            $table->boolean('hidden_by_default')->default(false);
            $table->unsignedBigInteger('permissions')->default(0);
            $table->unsignedSmallInteger('kick_power')->default(0);
            $table->unsignedSmallInteger('required_kick_power')->default(0);
            $table->boolean('shared')->default(false);
            $table->timestamps();

            $table->unique(['server_account_id', 'rank_name']);
            $table->foreign('server_account_id')->references('id')->on('server_accounts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranks');
    }
}
