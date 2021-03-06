<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->foreignId('server_account_id')->nullable();
            $table->timestamps();
            $table->ipAddress('ip');
            $table->unsignedMediumInteger('port');
            $table->text('info');
            $table->string('pastebin', 16);
            $table->enum('status', ['offline', 'online', 'waiting']);
            $table->smallInteger('cur_players');
            $table->smallInteger('max_players');
            $table->string('server_version', 16);
            $table->string('exiled_version', 16);
            $table->unsignedSmallInteger('options');

            $table->unique(['ip', 'port'], 'address');
            $table->foreign('server_account_id')->references('id')->on('server_accounts')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
