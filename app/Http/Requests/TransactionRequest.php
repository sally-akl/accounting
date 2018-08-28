<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\customRules\InvoiceIncome;

class TransactionRequest extends FormRequest
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
        $valid_rules = array();
        if($this->transfer_type == "income")
        {
           $valid_rules = [
               "to_account"=>"required|integer",
               "transfer_d"=>"required|date",
               "desc"=>"required|string",
               "amount"=>"required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
               "invoice_val"=>"required|integer",
               "transfer_type"=>"string",
               "check_invoice_income"=> [new InvoiceIncome]
           ];

        }
        else if($this->transfer_type == "expense")
        {
           $valid_rules = [
               "to_account"=>"required|integer",
               "transfer_d"=>"required|date",
               "desc"=>"required|string",
               "amount"=>"required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
               "expense_val"=>"required|integer",
               "transfer_type"=>"string"
           ];

        }
        else if($this->transfer_type == "transfer")
        {
           $valid_rules = [
               "to_account"=>"required|integer",
               "transfer_d"=>"required|date",
               "desc"=>"required|string",
               "amount"=>"required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
               "account_from"=>"required|integer",
               "transfer_type"=>"string"
           ];

        }

        return   $valid_rules;
    }
}
