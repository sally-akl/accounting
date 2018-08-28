<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tax extends Model
{
    protected $fillable = [
      'title','tax_rate'
    ];

    public function invoice_items()
    {
        return $this->hasMany('App\invoice_item');
    }
}
