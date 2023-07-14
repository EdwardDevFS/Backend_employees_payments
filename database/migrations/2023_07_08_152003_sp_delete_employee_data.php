<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpDeleteEmployeeData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE delete_employee_data(IN p_employee_id INT)
        BEGIN
        DECLARE employee_count INT;
  
        SELECT COUNT(*) INTO employee_count FROM employees WHERE id = p_employee_id;
        
        IF employee_count > 0 THEN
            DELETE FROM payments WHERE employee_id = p_employee_id;
            DELETE FROM employees WHERE id = p_employee_id;
            SELECT 'Employee Deleted' AS message;
        ELSE
            SELECT 'Employee Not Found' AS message;
        END IF;
        END";
    
        DB::unprepared("DROP PROCEDURE IF EXISTS delete_employee_data");
        DB::unprepared($procedure);
    }

    public function down()
    {
        //
    }
}
