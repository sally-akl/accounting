<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'fullname'=>'required|max:255',
            'email'=>'required|max:50|unique:customers,email,'.$this->route('id'),
            'phone'=>'max:255',
            'address'=>'max:255',
            'city_val'=>'integer',
            'branch_name'=>'required'
        ];
    }

}
