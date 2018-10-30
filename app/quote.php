<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quote extends Model
{

    protected $fillable = [
      'customer_id','quote_subject','quote_status','quote_date','quote_expire_date','quote_code_num','quote_discount_amount','quote_discount_type','quote_txt','quote_customer_txt','converted_to_invoce'
    ];

    public $quote_type = "quote";
    public function customer()
    {
        return $this->belongsTo('App\customer');
    }
    public function services()
    {
        return $this->belongsToMany('App\service', 'invoice_items','quote_id','service_id')->withPivot('price','invoice_type','qty','service_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User',"user_id");
    }





}
