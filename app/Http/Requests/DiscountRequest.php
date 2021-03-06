<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
          'bdate'=>'date',
          'emp_m_id'=>'required|integer',
          'sal_min_extra'=>'required|integer',
        //  'amount'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];
    }
}
