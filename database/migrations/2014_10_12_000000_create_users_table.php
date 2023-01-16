<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('status',1)->default('y');
            $table->char('company_code', 4);
            $table->string('key_devices')->nullable();
            $table->rememberToken();
            $table->date('deleted_at')->nullable();
            $table->timestamps();


            $table->foreign('company_code')->references('company_code')->on('company');
        });

        DB::unprepared('
        CREATE EXTENSION IF NOT EXISTS "uuid-ossp"; 
        ');

        DB::unprepared("
        CREATE OR REPLACE FUNCTION uuid_users()
        RETURNS TRIGGER
        LANGUAGE plpgsql
        AS $$
        BEGIN
            IF NEW.id IS NULL THEN
              NEW.id := uuid();
            END IF;
           RETURN NEW;
        END;
        $$;

        CREATE TRIGGER uuid_users
        BEFORE INSERT ON users
        FOR EACH ROW EXECUTE PROCEDURE uuid_users();
        ");
        // DB::unprepared("            
        //     CREATE TRIGGER before_insert_users
        //     BEFORE INSERT ON users
        //     FOR EACH ROW
        //     BEGIN
        //       IF new.id IS NULL THEN
        //         SET new.id = uuid();
        //       END IF;
        //     END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER [IF EXISTS] `before_insert_users`');
        Schema::dropIfExists('users');
    }
}
