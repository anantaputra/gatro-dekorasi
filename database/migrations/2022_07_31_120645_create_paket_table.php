<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->length(11);
            $table->integer('id_kategori')->length(11);
            $table->string('nama', 100);
            $table->integer('harga')->length(11);
            $table->text('isi_paket')->nullable();
            $table->integer('jml_tamu')->length(11)->nullable();
            $table->text('keterangan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pakets');
    }
}
