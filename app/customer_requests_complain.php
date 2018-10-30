<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_requests_complain extends Model
{

    protected $table="customer_requests_complain";

    public function customers()
    {
         return $this->belongsTo('App\customer','customer_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User',"user_id");
    }
}
