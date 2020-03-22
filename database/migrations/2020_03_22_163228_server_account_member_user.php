<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServerAccountMemberUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_account_member_user', function (Blueprint $table) {
            $table->unsignedBigInteger('server_account_member_id');
            $table->unsignedBigInteger('user_id');

            $table->unique('server_account_member_id', 'user_id');

            $table->foreign('server_account_member_id')->references('id')->on('server_account_members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_account_member_user');
    }
}
