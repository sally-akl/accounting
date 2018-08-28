<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{

    protected $fillable = [
      'title', 'country_id'
    ];

    public function customers()
    {
        return $this->hasMany('App\customer');
    }

    public function country()
    {
         return $this->belongsTo('App\country');
    }



}
