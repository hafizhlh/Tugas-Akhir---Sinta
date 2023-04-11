<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_barang_masuks', function (Blueprint $table) {
            $table->foreign('barang_masuk_id')->references('barang_masuk_id')->on('barang_masuks');
            $table->unsignedBigInteger('barang_masuk_id');
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('barang_id')->on('barangs');
            $table->bigIncrements('detail_barang_masuk_id');
            $table->integer('jumlah_barang_masuk');
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
        Schema::dropIfExists('detail_barang_masuks');
    }
}
