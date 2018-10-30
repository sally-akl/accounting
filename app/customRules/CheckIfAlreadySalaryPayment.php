<?php
namespace App\customRules;

use Illuminate\Contracts\Validation\Rule;
use App\transaction;

class CheckIfAlreadySalaryPayment implements Rule
{
    public function passes($attribute, $value)
    {
        $is_exist = false;
        $parts = explode("-",$value);
        $emp_major = isset($parts[0])?$parts[0]:"";
        $month = isset($parts[1])?$parts[1]:"";
        $year = isset($parts[2])?$parts[2]:"";

        if(!empty($emp_major) && !empty($month) && !empty($year))
        {
            $transaction_details = transaction::where("emp_major_id",$emp_major)->where("salary_of_month",$month)->where("emp_salary_year",$year)->get();
            if(count($transaction_details) > 0)
              $is_exist = true;
        }
        return !$is_exist;
    }

    public function message()
    {
        return trans('app.already_pay_that_month');
    }
}



 ?>
