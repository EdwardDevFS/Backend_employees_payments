<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpReadAllData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE read_all_data()
       BEGIN
            DECLARE total_amount DECIMAL(8, 2);
            DECLARE total_count INT;
            
            SELECT 
                e.id,
                e.dob,
                e.phone,
                e.email,
                e.address,
                (
                    SELECT CONCAT(e.first_name, ' ', e.second_name) 
                )AS client_name,
                (
                    SELECT SUM(amount)
                    FROM payments
                    WHERE employee_id = e.id
                ) AS Total,
                (
                    SELECT COUNT(*)
                    FROM payments
                    WHERE employee_id = e.id
                ) AS Payments
            FROM employees e;
        END";
    
        DB::unprepared("DROP PROCEDURE IF EXISTS read_all_data");
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
