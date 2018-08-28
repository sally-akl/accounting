<?php
namespace App\customRules;

use Illuminate\Contracts\Validation\Rule;
use App\emplyee_major;

class EmployeeCurrent implements Rule
{
    public function passes($attribute, $value)
    {
        $is_exist = false;
        $comp_emp_major = explode("-",$value);
        if(count($comp_emp_major) > 0)
        {
            $emp_id = $comp_emp_major[0];
            $major_id = $comp_emp_major[1];
            $current = $comp_emp_major[2];
            $current_off = $current=="on"?true:false;
            $is_exist = emplyee_major::where('emplyee_id',$emp_id)->where('major_id',$major_id)->exists();
            if(!$is_exist && !$current_off)
              $is_exist = true;
        }

        return !$is_exist;
    }

    public function message()
    {
        return trans('app.emp_first_time_current_check');
    }
}



 ?>
