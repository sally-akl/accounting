<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name'=>'required|max:255',
            'address'=>'max:255',
            'employee_email'=>'required|max:255|unique:employees,employee_email,'.$this->route('id'),
            'phone'=>'max:255',
            'status'=>'max:30',
            'details'=>'string',
            'join_date'=>'required|date',
            'branch_name'=>'required'
        ];
    }
}
