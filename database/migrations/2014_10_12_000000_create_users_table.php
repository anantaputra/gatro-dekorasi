<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->length(11);
            $table->string('nama', 150);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('kota', 150)->nullable();
            $table->string('alamat', 150)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->string('no_hp1', 13)->nullable();
            $table->string('no_hp2', 13)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
