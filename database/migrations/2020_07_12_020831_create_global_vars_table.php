<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateGlobalVarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_vars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group');
            $table->string('name');
            $table->string('param')->nullable();
            $table->string('desc')->nullable();
            $table->string('value')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
        });

        DB::unprepared("
            ALTER TABLE global_vars ALTER created_by TYPE uuid USING CAST(nullif(created_by, null) AS uuid);
            ALTER TABLE global_vars ALTER updated_by TYPE uuid USING CAST(nullif(updated_by, null) AS uuid);
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_vars');
    }
}
