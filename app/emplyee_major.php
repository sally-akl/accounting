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
       return $this->hasMany('App\extra_salary','emp_major_id');
    }

    public function employeeBouns()
    {
       return $this->hasMany('App\bouns','emp_major_id');
    }

    public function employeeDiscount()
    {
       return $this->hasMany('App\discount','emp_major_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User',"user_id");
    }

    public function salarySum($month,$year)
    {
        $bouns = $this->employeeBouns()->whereRaw("month(bonus_date) = ".$month." and year(bonus_date) = ".$year)->get();
        $discount = $this->employeeDiscount()->whereRaw("month(discount_date) = ".$month." and year(discount_date) = ".$year)->get();
        $employee_salary = $this->current_salary;
        $extra = $this->employeeExtraSalary;
        $total_increase = 0;
        foreach($extra as $e)
        {
            $per = $e->extra_min->percentage;
            $after = $per;
            if($e->extra_min->val_type == "percentage")
               $after = (($per/100) * $this->current_salary);
            $total_increase += $after;
        }
        $employee_salary = $this->current_salary + $total_increase;
        $total_increase = 0;
        foreach($bouns as $b)
        {
            $per = $b->extra_min->percentage;
            $after = $per;
            if($b->extra_min->val_type == "percentage")
               $after = (($per/100) * $this->current_salary);
            $total_increase += $after;
        }
        $employee_salary += $total_increase;
        $total_increase = 0;
        foreach($discount as $b)
        {
            $per = $b->extra_min->percentage;
            $after = $per;
            if($b->extra_min->val_type == "percentage")
               $after = (($per/100) * $this->current_salary);
            $total_increase += $after;
        }
        $employee_salary -= $total_increase;
        return $employee_salary;
    }
}
