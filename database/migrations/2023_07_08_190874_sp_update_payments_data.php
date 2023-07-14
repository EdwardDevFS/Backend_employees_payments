<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpUpdatePaymentsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE update_payment_data(
                IN p_id_employee INT,
                IN p_action VARCHAR(255),
                IN p_id_payment INT,
                IN p_id_transaction VARCHAR(255),
                IN p_amount FLOAT,
                IN p_date DATE
            )
            BEGIN
                DECLARE employee_count INT;
                IF p_action = 'update' THEN
                    SET @employee_count = (SELECT COUNT(*) FROM employees WHERE id = p_id_employee);
                    IF employee_count > 0 THEN
                        IF p_id_payment IS NOT NULL THEN 
                            UPDATE payments
                            SET 
                                id_transaction = p_id_transaction,
                                amount = p_amount,
                                date = p_date,
                                updated_at = NOW()
                                WHERE id = p_id_payment;
                        ELSE
                            INSERT INTO payments(id_transaction, amount, date, employee_id, created_at, updated_at) VALUES(p_id_transaction, p_amount, p_date, p_id_employee, NOW(), NOW());
                        END IF;
                    ELSE
                        SELECT 'Employee Not Found' AS message;
                    END IF;
                ELSE
                    INSERT INTO payments(id_transaction, amount, date, employee_id, created_at, updated_at) VALUES(p_id_transaction, p_amount, p_date, p_id_employee, NOW(), NOW());
                    SELECT 'Employee payment updated' AS message;
                END IF;
            END";
    
        DB::unprepared("DROP PROCEDURE IF EXISTS update_payment_data");
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
