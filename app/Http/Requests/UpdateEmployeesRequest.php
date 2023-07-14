<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'second_name' => ['required'],
            'dob' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'payments' => ['required'],
        ];
    }
}