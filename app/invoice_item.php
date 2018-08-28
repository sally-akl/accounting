<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice_item extends Model
{
    protected $fillable = [
      'service_id','invoice_id','tax_id','qty','price','invoice_type'
    ];
}
