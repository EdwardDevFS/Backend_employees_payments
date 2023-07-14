<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

final class ClientsServices
{
    public function store($data)
    {
        $procedure = "CALL store_employee(?,?,?,?,?,?)";
        $params = [
            $data->first_name,
            $data->second_name,
            $data->dob,
            $data->phone,
            $data->email,
            $data->address,
        ];
        $client_id = DB::select($procedure, $params);
        return $client_id;
    }

    
    
    
    public function readAllData(){
        $procedure = "CALL read_all_data()";
        $response = DB::select($procedure);
        return $response;
    }
    public function readDataWithId($client_id){
        $procedure = "CALL read_data_with_id(?)";
        $params = [
            $client_id
        ];
        $response = DB::selectOne($procedure, $params);
        if($response){
            $response->payments = json_decode($response->payments);    
        }
        return $response;
    }
    public function updateEmployee($client_id,$data){
        $procedure = "CALL update_employee_data(?,?,?,?,?,?,?)";
        $params = [
            $client_id,
            $data->first_name,
            $data->second_name,
            $data->dob,
            $data->phone,
            $data->email,
            $data->address,
        ];
        DB::statement($procedure, $params);
    }
    public function deleteEmployee($client_id){
        $procedure = "CALL delete_employee_data(?)";
        $params = [
            $client_id
        ];
        $res = DB::select($procedure, $params);
        return $res;    
    }   
}