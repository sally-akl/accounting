<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    public function account()
    {
        return $this->belongsTo('App\account');
    }
    public function employee()
    {
        return $this->belongsTo('App\employee');
    }
    public function customer()
    {
        return $this->belongsTo('App\customer');
    }
    public function expense()
    {
        return $this->belongsTo('App\expense_type');
    }
    public function invoice()
    {
        return $this->belongsTo('App\invoice');
    }


}
