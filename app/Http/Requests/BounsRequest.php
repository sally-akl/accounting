<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\customRules\CheckIfAlreadySalaryPayment;

class BounsRequest extends FormRequest
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
          'sal_min_extra'=>'required|integer',
          'emp_m_id'=>'required|integer',
          'majoremployee_month_year'=> [new CheckIfAlreadySalaryPayment]
          //'amount'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];
    }
}
