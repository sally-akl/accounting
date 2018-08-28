<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\customRules\EmployeeMajorNotRepeat;
use App\customRules\EmployeeCurrent;

class employeeMajorRequest extends FormRequest
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
          'employee_val'=>'required|integer',
          'major_val'=>'required|integer',
          'join_date'=>'date',
          'is_current'=>'string',
          'salary'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
          'compond_emp_major'=> [new EmployeeMajorNotRepeat],
          //'compond_emp_major_current'=> [new EmployeeCurrent],
        ];
    }
}
