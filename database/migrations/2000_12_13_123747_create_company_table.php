<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->default(DB::raw('uuid_generate_v4()'));
            $table->char('company_code', 7)->unique();
            $table->text('company_name');
            $table->string('create_by', 100)->nullable();
            $table->string('update_by', 100)->nullable();
            $table->string('delete_by', 100)->nullable();
            $table->date('deleted_at')->nullable();
            $table->tinyInteger('delete_mark')->default('0');
            $table->timestamps();
        });

        DB::unprepared("
        CREATE OR REPLACE FUNCTION uuid_company() 
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
        
        CREATE TRIGGER uuid_company
        BEFORE INSERT ON company
        FOR EACH ROW EXECUTE PROCEDURE uuid_company();
        ");

        // DB::unprepared("
        //     CREATE TRIGGER before_insert_company
        //     BEFORE INSERT ON company
        //     FOR EACH ROW
        //     BEGIN
        //       IF new.uuid IS NULL THEN
        //         SET new.uuid = uuid();
        //       END IF;
        //     END"
        //   );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
