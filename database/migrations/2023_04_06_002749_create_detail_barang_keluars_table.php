<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_barang_keluars', function (Blueprint $table) {
            $table->foreign('barang_keluar_id')->references('barang_keluar_id')->on('barang_keluars');
            $table->unsignedBigInteger('barang_keluar_id');
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('barang_id')->on('barangs');
            $table->bigIncrements('detail_barang_keluar_id');
            $table->integer('jumlah_barang_keluar');
            $table->timestamps();
            $table->tinyInteger('delete_mark')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_barang_keluars');
    }
}
