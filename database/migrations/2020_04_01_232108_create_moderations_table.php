<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moderations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('user_id_type', ['steam', 'discord']);
            $table->string('user_name');
            $table->unsignedBigInteger('admin_id');
            $table->enum('admin_id_type', ['steam', 'discord']);
            $table->string('admin_name');
            $table->string('reason');
            $table->enum('moderation_type', ['warning', 'ban']);
            $table->foreignId('server_account_id');
            $table->timestamps();
            $table->timestamp('expiry_date');

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
        Schema::dropIfExists('moderations');
    }
}
