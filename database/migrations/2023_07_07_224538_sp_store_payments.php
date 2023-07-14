<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpStorePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE store_payments(
            IN p_transaction VARCHAR(50),
            IN p_amount FLOAT,
            IN p_date DATE,
            IN p_employee_id INT)
        BEGIN
            INSERT INTO payments (id_transaction, amount, date, employee_id,created_at, updated_at) 
            VALUES (p_transaction, p_amount, p_date, p_employee_id,NOW(), NOW());
        END";
    
        DB::unprepared("DROP PROCEDURE IF EXISTS store_payments");
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
