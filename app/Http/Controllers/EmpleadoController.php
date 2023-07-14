<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;
use App\Http\Services\ClientsServices;
use App\Http\Services\PaymentServices;

class EmpleadoController extends Controller
{
    
    public $employeeService;
    public $paymentService;

    public function __construct(ClientsServices $employeeService, PaymentServices $paymentService)
    {
        $this->employeeService = $employeeService;
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $response = $this->employeeService->readAllData();
        return $response;
    }
    
    public function create()
    {
        //
    }

    // $this->service->payments($client_id, $request->payments);
    public function store(StoreEmployeesRequest $request)
    {
        $client_id = $this->employeeService->store($request);
        $this->paymentService->storePayments($client_id, $request->payments);
        return 'Employee Created'; 
    }

    public function show(int $id)
    {
        $res = $this->employeeService->readDataWithId($id);
        if(!$res){
            return "Employee not found";
        }
        return [
            'data' => $res
        ];
    }

    public function edit(Request $request)
    {
    }

    public function update(int $id, Request $request)
    {
        $this->employeeService->updateEmployee($id, $request);   
        $data = $this->paymentService->updatePayment($id, $request->payments);
        return $data;
    }

    public function destroy(int $id)
    {
        $res = $this->employeeService->deleteEmployee($id);
        return $res;
    }
}
