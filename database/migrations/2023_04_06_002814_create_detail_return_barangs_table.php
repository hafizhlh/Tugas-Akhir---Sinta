<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailReturnBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_return_barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('return_id');
            $table->foreign('return_id')->references('return_id')->on('return_barangs');
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('barang_id')->on('barangs');
            $table->bigIncrements('detail_return_id');
            $table->integer('jumlah_barang_return');
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
        Schema::dropIfExists('detail_return_barangs');
    }
}
