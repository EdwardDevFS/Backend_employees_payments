<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpStoreEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE store_employee(
            IN p_first_name VARCHAR(255),
            IN p_second_name VARCHAR(255),
            IN p_dob DATE,
            IN p_phone VARCHAR(255),
            IN p_email VARCHAR(255),
            IN p_address VARCHAR(255))
                BEGIN
                INSERT INTO employees(first_name,second_name, dob, phone, email, address,created_at, updated_at) 
                VALUES (p_first_name,p_second_name, p_dob, p_phone, p_email, p_address,NOW(), NOW());
                SELECT @@identity id;
                END";

        DB::unprepared("DROP procedure IF EXISTS store_employee");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
