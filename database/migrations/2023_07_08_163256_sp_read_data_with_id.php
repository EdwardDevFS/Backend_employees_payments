<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpReadDataWithId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE read_data_with_id(IN p_employee_id INT)
        BEGIN
        DECLARE employee_count INT;
  
        SELECT COUNT(*) INTO employee_count FROM employees WHERE id = p_employee_id;
        SELECT 
            e.first_name,
            e.second_name,
            e.dob,
            e.phone,
            e.email,
            e.address,
            (
                SELECT JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id', p.id,
                        'id_transaction', p.id_transaction,
                        'amount', p.amount,
                        'date', p.date
                    )
                )
                FROM payments p
                WHERE p.employee_id = e.id
            )AS payments
        FROM employees e where id = p_employee_id;
        END";
    
        DB::unprepared("DROP PROCEDURE IF EXISTS read_data_with_id");
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
