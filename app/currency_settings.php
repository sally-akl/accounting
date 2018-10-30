<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currency_settings extends Model
{

    protected $fillable = [
      'currency_date', 'current_currency','EGP','SAR','USD'
    ];

    protected $table = "currancy_converter";



}
