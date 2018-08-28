<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class employeeMajorCodeRequest extends FormRequest
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
            'employee_code'=>'required|max:255|unique:emplyee_majors,employee_code,'.$this->route('id'),
        ];
    }
}
