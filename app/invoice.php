<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable = [
      'customer_id','invoice_status','invoice_date','invoice_payment_term','invoice_code_num','discount_amount','discount_type'
    ];
    public $invoice_item_type = "invoice";

    public function CustomerData()
    {
        return $this->belongsTo('App\customer','customer_id');
    }

    public function services()
    {
        return $this->belongsToMany('App\service', 'invoice_items','invoice_id','service_id')->withPivot('price','invoice_type','qty','service_id');
    }

    public function tax()
    {
        return $this->belongsTo('App\tax');
    }

    public function transactions()
    {
       return $this->hasMany('App\transaction');
    }

    public function getprice()
    {
        $price = 0 ;
        foreach ($this->services as $key => $service)
         {
            if($service->pivot->invoice_type == $this->invoice_item_type)
              $price += $service->pivot->qty * $service->pivot->price;
         }
         $discount_value = $this->discount_amount;
         if($this->discount_type != "amount")
         {
              $discount_value = ($price * $this->discount_amount) /100;
         }
         $price =  $price - $discount_value;
         return  $price;
    }

}
