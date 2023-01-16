<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->integer('urutan');
            $table->string('judul');
            $table->string('gambar');
            $table->string('url');
            $table->string('status')->default('active');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('delete_mark')->default('0');
            $table->timestamps();
        });

        DB::unprepared("
        CREATE OR REPLACE FUNCTION uuid_landing_page() 
        RETURNS TRIGGER
        LANGUAGE plpgsql
        AS $$
        BEGIN
            IF NEW.uuid IS NULL THEN
              NEW.uuid := uuid();
            END IF;
           RETURN NEW;
        END;
        $$;
        
        CREATE TRIGGER uuid_landing_page
        BEFORE INSERT ON landing_page
        FOR EACH ROW EXECUTE PROCEDURE uuid_landing_page();
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_page');
    }
}
