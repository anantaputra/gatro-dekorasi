<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->length(11);
            $table->integer('id_user')->length(11);
            $table->integer('id_paket')->length(11);
            $table->string('lokasi', 20);
            $table->text('alamat_acara');
            $table->date('tgl_acara');
            $table->date('tgl_kembali');
            $table->string('catatan')->nullable();
            $table->string('status')->default('menunggu');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_paket')->references('id')->on('paket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
