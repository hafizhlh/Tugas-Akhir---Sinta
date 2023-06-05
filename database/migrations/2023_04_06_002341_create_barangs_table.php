<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('barang_id');
            $table->uuid('user_id');
            $table->string('barcode_barang', 100);
            $table->string('nama_barang', 100);
            $table->integer('jumlah_barang')->nullable();
            $table->string('keterangan_barang', 1000);
            $table->integer('kategori_id');
            $table->tinyInteger('delete_mark')->default('0');
            $table->timestamps();
            $table->foreign('kategori_id')->references('id')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
