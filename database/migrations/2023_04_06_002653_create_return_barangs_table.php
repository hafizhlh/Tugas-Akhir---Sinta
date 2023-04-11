<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_barangs', function (Blueprint $table) {
            $table->bigIncrements('return_id', 20);
            $table->uuid('user_id');
            $table->unsignedBigInteger('barang_keluar_id');
            $table->foreign('barang_keluar_id')->references('barang_keluar_id')->on('barang_keluars');
            $table->date('waktu_return');
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
        Schema::dropIfExists('return_barangs');
    }
}
