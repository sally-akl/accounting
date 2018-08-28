<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{

    protected $fillable = [
      'full_name','email','phone','address','city_id'
    ];

    public function city()
    {
       return $this->belongsTo('App\city');
    }

    public function invoices_data()
    {
        return $this->hasMany('App\invoice');
    }

    public function quotes_data()
    {
        return $this->hasMany('App\quote');
    }

    public function accounts()
    {
       return $this->belongsToMany('App\account', 'accounts_persons');
    }

    public function transactions()
    {
       return $this->hasMany('App\transaction');
    }


}
