<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'bankname'=>'required|max:255',
            'number'=>'required|max:255',
            'location'=>'required|max:255',
            'city'=>'required|max:255',
            'balance'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ];
    }
}
