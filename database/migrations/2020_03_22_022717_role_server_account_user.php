<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RoleServerAccountUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_server_account_user', function (Blueprint $table) {
//            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('server_account_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->unique('server_account_id', 'user_id');

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('server_account_id')->references('id')->on('server_accounts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('role_server_account_user');
    }
}
