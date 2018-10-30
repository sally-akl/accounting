<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'invoice_status'=>'required|string',
            'invoices_date'=>'required|date',
            'invoice_payment_term'=>'numeric',
            'invoices_discount'=>'integer',
            'invoices_discount_type'=>'string',
            'currency'=>'required'
           ];
    }
}
