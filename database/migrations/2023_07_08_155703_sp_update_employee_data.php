<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpUpdateEmployeeData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE update_employee_data(
            IN p_employee_id INT,
            IN p_first_name VARCHAR(255),
            IN p_second_name VARCHAR(255),
            IN p_dob DATE,
            IN p_phone VARCHAR(255),
            IN p_email VARCHAR(255),
            IN p_address VARCHAR(255)
        )
        BEGIN
            UPDATE employees
            SET 
                first_name = p_first_name,
                second_name = p_second_name,
                DOB = p_dob,
                phone = p_phone,
                email = p_email,
                address = p_address,
                updated_at = NOW()
            WHERE id = p_employee_id;
        end";
    
        DB::unprepared("DROP PROCEDURE IF EXISTS update_employee_data");
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
