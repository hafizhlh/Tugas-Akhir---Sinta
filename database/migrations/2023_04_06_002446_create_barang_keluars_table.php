<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->bigIncrements('barang_keluar_id');
            $table->uuid('user_id');
            $table->date('tgl_pengambilan');
            $table->string('no_dof_etiket', 20);
            $table->tinyInteger('delete_mark')->default('0');
            $table->string('keterangan', 1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_keluars');
    }
}
