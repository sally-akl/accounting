<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class emplyee_major extends Model
{

    protected $fillable = [
      'emplyee_id','major_id','join_date','is_current','current_salary','employee_code'
    ];

    public function emplyeeData()
    {
        return $this->belongsTo('App\employee','emplyee_id');
    }

    public function majorData()
    {
       return $this->belongsTo('App\major','major_id');
    }

    public function employeeExtraSalary()
    {
       return $this->hasMany('App\extra_salary');
    }

    public function employeeBouns()
    {
       return $this->hasMany('App\bouns');
    }

    public function employeeDiscount()
    {
       return $this->hasMany('App\discount');
    }
}
