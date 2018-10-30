<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
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
            'customer_name'=>'required|integer',
            'subject'=>'required|string',
            'quote_status'=>'required|string',
            'quote_date'=>'required|date',
            'expire_date'=>'required|date',
            'quote_discount'=>'integer',
            'quote_discount_type'=>'string',
            'quote_txt'=>'string',
            'quote_customer'=>'string',
            'currency'=>'required'
           ];
    }
}
