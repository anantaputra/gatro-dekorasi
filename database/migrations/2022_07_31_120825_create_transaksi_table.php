<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('kd_transaksi', 20)->primary();
            $table->foreignId('id_pesanan');
            $table->string('pembayaran');
            $table->string('transaction_id');
            $table->integer('total');
            $table->string('payment_type')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id')->on('pesanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
