<?php
namespace App\customRules;

use Illuminate\Contracts\Validation\Rule;
use App\invoice;
use App\invoice_item;
use App\transaction;

class InvoiceIncome implements Rule
{
    public function passes($attribute, $value)
    {

        $parts = explode("-",$value);
        $invoice_id = $parts[0];
        $extra_price = $parts[1];
        $is_exist = true;
        $invoice = invoice::find($invoice_id);
        $invoice_items = $invoice->services;
        $total_invoice_price =0;
        foreach($invoice_items as $item)
        {
           $total_invoice_price += $item->pivot->qty * $item->pivot->price;
        }

        $transfers_sum = transaction::where("transfer_type","income")->where("invoice_id",$invoice_id)->sum('transfer_amount');
        $transfers_sum += $extra_price;
        if($transfers_sum <=  $total_invoice_price)
            $is_exist = false;

        return !$is_exist;
    }

    public function message()
    {
        return trans('app.total_income_invoice_is_more_than_its_value');
    }
}



 ?>
