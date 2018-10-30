<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\classes\Common;
use App\extra_salary;
use App\extra_mis_salaries;
use App\bouns;
use App\discount;
use App\category;
use App\major;
use App\employee;
use App\emplyee_major;
use App\city;
use App\country;
use App\customer;
use App\transaction;
use App\invoice;
use App\User;
use App\contracts;
use App\customer_requests_complain;
use App\customRules\EmployeeMajorNotRepeat;
use App\customRules\CheckIfAlreadySalaryPayment;
use Session;
use Auth;
use Validator;

class AjaxController extends Controller
{


     public function __construct()
     {
       $this->middleware(function ($request, $next) {
             return $next($request);
        });

     }

     public function employee_salary_details($id)
     {
         $transaction = transaction::find($id);
         $employee_major = $transaction->majorData;
         $extra_salary = $employee_major->employeeExtraSalary;
         $bouns = $employee_major->employeeBouns()->whereRaw("month(bonus_date) = ".$transaction->salary_of_month." and year(bonus_date) = ".$transaction->emp_salary_year)->get();
         $discount = $employee_major->employeeDiscount()->whereRaw("month(discount_date) = ".$transaction->salary_of_month." and year(discount_date) = ".$transaction->emp_salary_year)->get();
         $employee_salary = $employee_major->current_salary;
         return view('ajax.ajax_salary_details',array("employee_major"=> $employee_major,"basic_salary"=>$employee_major->current_salary , "extra"=> $extra_salary , "bouns"=> $bouns , "discount"=>$discount , "transaction"=>$transaction));

     }

     public function get_invoice_details($id)
     {
         $invoice = invoice::find($id);
         if($invoice != null)
         {
              $currancy = Common::getCurrencyText($invoice->currancy);
              echo  json_encode(array("msg"=>"sucess","currancy"=>$currancy,"price"=>$invoice->getprice()));
              exit();
         }

         echo json_encode(array("msg"=>"fail"));
     }

     public function setRelatedUser($id)
     {
        $users = User::where("id","!=",1)->get();
        return view('ajax.related_employee_user',array("users"=>$users,"id"=>$id));
     }

     public function setUserEmpStore(Request $request)
     {
         $employee = employee::find($request->emp_id);
         if($employee != null)
         {
             $employee->related_user_id  = $request->user_val;
             $employee->save();
             if($request->ajax())
             {
                 echo json_encode(array("sucess"=>true));
                 exit();
             }
         }

     }

     public function getTransactionsByInvoices($id)
     {
         $transfers = transaction::where("invoice_id",$id)->paginate(5);
         return view('ajax.ajax_invoice_trasaction',array("transfers"=>$transfers));
     }

     public function getContractDetails($id)
     {
         $contract = contracts::find($id);
         return view('ajax.ajax_contract',array("contract"=>$contract));
     }


}
