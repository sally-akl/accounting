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
    public function users()
    {
        return $this->belongsTo('App\User',"user_id");
    }
    public function majorData()
    {
        return $this->belongsTo('App\emplyee_major','emp_major_id');
    }
}
