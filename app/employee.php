<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{

    protected $fillable = [
      'employee_name','employee_address','employee_email','employee_phone','employee_status','employee_details','employee_join_date'
    ];

    public function emplyee_majar_data()
    {
        return $this->hasMany('App\emplyee_major');
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
