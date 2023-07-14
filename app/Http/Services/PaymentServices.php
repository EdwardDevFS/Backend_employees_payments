<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

final class PaymentServices{
    public function storePayments($client_id, $payments)
    {
        foreach($payments as $payment){
            // return $payment;
            $procedure = "CALL store_payments(?,?,?,?)";
            $params = [
                $payment['id_transaction'],
                $payment['amount'],
                $payment['date'],
                $client_id[0]->id,
            ];
            // return $procedure;
            // return $params;
            DB::statement($procedure, $params);
        }
        
    }
    public function getAllPayments($client_id){

        $procedure = "CALL get_employee_payments(?)";
        $params = [
            $client_id[0]->id
        ];
        
        $results = DB::select($procedure, $params);

        return $results;
    }
    public function updatePayment($client_id, $payments){
        $lenght = count($payments);
        $validation = "CALL sp_validate_for_update(?,?)";
        $params = [
            $lenght,
            $client_id
        ];
        $res = DB::select($validation, $params);
        $action = $res ? 'insert':'update';
        foreach($payments as $payment){
            $procedure = "CALL update_payment_data(?,?,?,?,?,?)";
            $params = [
                $client_id,
                $action,
                $payment['id'],
                $payment['id_transaction'],
                $payment['amount'],
                $payment['date'],
            ];
            $res = DB::select($procedure, $params);
        }
        
    }

}