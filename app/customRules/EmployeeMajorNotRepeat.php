<?php
namespace App\customRules;

use Illuminate\Contracts\Validation\Rule;
use App\emplyee_major;

class EmployeeMajorNotRepeat implements Rule
{
    public function passes($attribute, $value)
    {
        $is_exist = false;
        $comp_emp_major = explode("-",$value);
        if(count($comp_emp_major) > 0)
        {
            $emp_id = $comp_emp_major[0];
            $major_id = $comp_emp_major[1];
            $is_exist = emplyee_major::where('emplyee_id',$emp_id)->where('major_id',$major_id)->exists();
        }

        return !$is_exist;
    }

    public function message()
    {
        return trans('app.emp_major_already_exist');
    }
}



 ?>
