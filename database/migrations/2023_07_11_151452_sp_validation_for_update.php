<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpValidationForUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE sp_validate_for_update(IN p_request_lenght_payments INT, IN p_employee_id INT)
        BEGIN
            declare lenght_control INT;
            SELECT COUNT(*) INTO lenght_control FROM payments p2 WHERE p2.employee_id = p_employee_id;
            IF p_request_lenght_payments < lenght_control THEN
                DELETE FROM payments WHERE employee_id = p_employee_id;
                SELECT 'deleted' AS message;
            END IF;
        END;";
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_validate_for_update");
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
