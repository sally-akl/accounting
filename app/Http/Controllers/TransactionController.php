<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\account;
use App\invoice;
use App\expense_type;
use App\settings;
use App\emplyee_major;
use App\extra_salary;
use App\employee;
use App\bouns;
use App\discount;
use App\Http\Requests\TransactionRequest;
use App\customRules\CheckIfAlreadySalaryPayment;
use App\classes\Common;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Authenticated;
use Session;
use Auth;
use App\templates;

class TransactionController extends Controller
{

    protected $pagination_num = 3;
    protected $invoices;
    protected $expense_type;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $list =  invoice::select("invoices.*")->whereRaw('1 = 1');
            $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
            $this->invoices = $list->get();
            $this->expense_type = expense_type::all();

            return $next($request);

        });
    }

    public function index($trans_type)
    {
        Session::put('filtered_invoice',null);

        $list =  transaction::whereRaw("1=1");
        if($trans_type != "all")
           $list =  transaction::where("transfer_type",$trans_type);

        $list = Common::user_filter_by_role($list,false,array(),"");
        $transfers = $list->orderBy("id","desc")->paginate($this->pagination_num);

        $currency = "";
        if(count($this->invoices) > 0 && $trans_type == "income")
          $currency =  Common::getCurrencyText( $this->invoices[0]->currancy);

        if($trans_type != "all")
          return view('transaction.index_new',["transfers"=>$transfers , "branches"=>Auth::user()->active_branch, "trans_type"=>$trans_type ,"invoices"=>$this->invoices , "expense_type"=>$this->expense_type,"currency"=>$currency]);

          return view('transaction.index',["transfers"=>$transfers , "branches"=>Auth::user()->active_branch, "trans_type"=>$trans_type  , "invoices"=>$this->invoices , "expense_type"=>$this->expense_type]);
    }

    public function invoices_income($id)
    {
        Session::put('filtered_invoice',$id);
        $list =  transaction::where("transfer_type","income")->where("invoice_id",$id);
        $list = Common::user_filter_by_role($list,false,array(),"");
        $transfers = $list->orderBy("id","desc")->paginate($this->pagination_num);
        return view('transaction.index',["transfers"=>$transfers ,"branches"=>Auth::user()->active_branch, "trans_type"=>"income" ,"invoices"=>$this->invoices , "expense_type"=>$this->expense_type]);
    }

    public function create($trans_type,Request $request)
    {
        $action = "";
        $emp_id = "";
        $salary_type= "";
        $total_salary = 0;
        if($request->query("action") != null)
          $action = $request->query("action");
        if($request->query("emp_id") != null)
        {
           $emp_id = $request->query("emp_id");
           if($action == "add_emplyee_payment")
           {
                $settings = settings::find(1);
                $salary_type= $settings->salary_type;

                $employee_data = emplyee_major::where("emplyee_id",$emp_id)->first();
                $total_salary = $employee_data->current_salary;
                $extra_salary = extra_salary::where("emp_major_id",$employee_data->id);
                $bouns = bouns::where("emp_major_id",$employee_data->id);
                $discount = discount::where("emp_major_id",$employee_data->id);
                foreach($extra_salary as $salary)
                {
                   $total_salary += $salary->extra_amount;
                }
                foreach($discount as $d)
                {
                   $total_salary -= $d->discount_amount;
                }

                if($salary_type == "weekly")
                  $total_salary = $total_salary/4;

           }

        }


        if($request->query("invoice_id") != null)
          Session::put('filtered_invoice',$request->query("invoice_id"));
        return view('transaction.add',  ["trans_type"=>$trans_type ,"branches"=>Auth::user()->active_branch,"invoices"=>$this->invoices , "expense_type"=>$this->expense_type,"action"=>$action,"emp_id"=>$emp_id,"salary_type"=>$salary_type ,"total_salary"=>$total_salary]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {

         $code = Common::GenerateCode(10,'transaction','transfer_code_num');
         $transaction = new transaction();
         $transaction->transfer_code_num = $code;
         $transaction->transfer_date =  date("Y-m-d H:i", strtotime($request->transfer_d));
         $transaction->transfer_desc = $request->desc;
         $transaction->transfer_amount = $request->amount;
         $transaction->transfer_type = $request->transfer_type;
         if($request->transfer_type == "income")
         {
            $transaction->invoice_id = $request->invoice_val;
            $transaction->account_to_id = null;
            $transaction->salary_type = null;
            $transaction->currancy = invoice::find($request->invoice_val)->currancy;
            $transaction->converted_transfer_amount =   Common::convertCurrency($transaction->currancy,Auth::user()->currency,$request->amount);


         }
         else if($request->transfer_type == "expense")
         {
            $transaction->expense_type_id = $request->expense_val;
            $transaction->person_name = $request->from_person;
            $transaction->currancy = $request->currency;
            $transaction->converted_transfer_amount =   Common::convertCurrency($transaction->currancy,Auth::user()->currency,$request->amount);

            if($request->action_type == "add_emplyee_payment")
            {
                $transaction->account_from_id = $request->account_from;
                $transaction->employee_id = $request->emp_id;
                $transaction->salary_type = "monthly";
                $transaction->emp_major_id = $request->emp_major_id;
                $transaction->salary_of_month = $request->employee_month_of;
                $transaction->emp_salary_year = $request->year_of;

                $transaction->account_to_id = null;

            }
            else {
              $transaction->account_to_id = null;
              $transaction->salary_type = null;
            }

         }
         else if($request->transfer_type == "transfer")
         {
            $transaction->account_from_id = null;
            $transaction->account_to_id = null;
            $transaction->salary_type = null;
         }
         $transaction->user_id = Auth::user()->id;
         if($request->logo != null)
         {
              $imageName = time().'.'.$request->logo->getClientOriginalExtension();
              $request->logo->move(public_path('images'), $imageName);
              $transaction->uploaded_file =   $imageName;
         }

         $transaction->branch_id = $request->branch_name;
         $transaction->amount_in_character = $request->amount_in_character;
         $transaction->save();

         $filtered_invoice_id = Session::get('filtered_invoice');

      /*   if($filtered_invoice_id == null && $request->action_type != "add_emplyee_payment")
           return redirect('/transactions/employee/salary/'.$request->emp_id."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));  */
           if($filtered_invoice_id == null && empty($request->action_type))
            return redirect('/transactions'."/".$request->transfer_type."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
       elseif($request->action_type == "add_emplyee_payment")
           return redirect("employee"."/".app()->getLocale()."?branch=".$request->query('branch'));
        else if($filtered_invoice_id != null && $request->action_type == "add_payment")
           return redirect("invoice/".$transaction->invoice_id."/show"."/".app()->getLocale()."?branch=".$request->query('branch'));

           return redirect('/transactions/income/'.$filtered_invoice_id."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }



    public function show($id)
    {
        $transaction = transaction::find($id);
        return view('transaction.show',compact('transaction'));
    }

    public function destroy($id)
    {
        $transfer = transaction::find($id);
        $transfer->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {

         $trans_type = $request->transfer_type2;
         $from=$to="";
         if(!empty($request->transfer_from))
            $from = date("Y-m-d H:i", strtotime($request->transfer_from));
         if(!empty($request->transfer_to))
            $to = date("Y-m-d H:i", strtotime($request->transfer_to));


          $query = transaction::whereRaw("1=1")->where("transfer_type", $trans_type );


         if(!empty($from) && !empty($to))
         {

              $query = $query->where(function($query2) use ($from,$to){
                          $query2->whereBetween('transfer_date',array($from,$to));
              });

         }
         else if(!empty($from))
         {
              $query = $query->where('transfer_date', $from );
         }

         switch($trans_type)
         {
            case 'income':
              $invoice_val = $request->invoice_val;
              if($invoice_val !=0)
                 $query = $query->where('invoice_id',$invoice_val );
              break;
            case 'expense':
              $expense_val = $request->expense_val;
              if($expense_val != 0)
                 $query = $query->where('expense_type_id',$expense_val );
              break;

         }

         $query = Common::user_filter_by_role($query,false,array(),"");
         $transfers = $query->orderBy("id","desc")->paginate($this->pagination_num);
         return view('transaction.index',["transfers"=>$transfers , "branches"=>Auth::user()->active_branch,"trans_type"=>$request->transfer_type,"invoices"=>$this->invoices , "expense_type"=>$this->expense_type]);
    }

    public function employee_search(Request $request)
    {
         $from = date("Y-m-d", strtotime($request->transfer_from));
         $to = date("Y-m-d", strtotime($request->transfer_to));
         $query = transaction::where("employee_id",$request->emp_id);
         if(!empty($from) && !empty($to))
         {
              $query = $query->where(function($query2) use ($from,$to){
                          $query2->whereBetween('transfer_date',array($from,$to));
              });
         }
         else if(!empty($from))
         {
              $query = $query->where('transfer_date', $from );
         }
        $query = Common::user_filter_by_role($query,false,array(),"");
        $transfers = $query->where("transfer_type","expense")->orderBy("id","desc")->paginate($this->pagination_num);
        $employee = employee::find($request->emp_id);
        return view('transaction.employee_transactions',["transfers"=>$transfers ,"branches"=>Auth::user()->active_branch, "employee"=>$employee]);
    }


    public function balance()
    {
        return view('transaction.balance',[]);
    }
    public function balanceTransactionDetails($id)
    {
        $query = transaction::where("account_to_id",$id);
        $query = Common::user_filter_by_role($query,false,array(),"");
        $transfers = $query->orderBy("id","desc")->paginate($this->pagination_num);
        return view('transaction.balance_transfer_details',["transfers"=>$transfers,"branches"=>Auth::user()->active_branch,"account_title"=>account::find($id)->bank_name]);
    }
    public function invoices()
    {
       $list =  invoice::where("invoice_status","paid");
       $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
        $invoices = $list->orderBy("invoices.id","desc")->paginate($this->pagination_num);
        return view('transaction.invoices',compact('invoices'));
    }
    public function invoicesDetails($id)
    {

      $query = transaction::where("invoice_id",$id);
      $query = Common::user_filter_by_role($query,false,array(),"");
      $transfers = $query->orderBy("id","desc")->paginate($this->pagination_num);
      return view('transaction.balance_transfer_details',["transfers"=>$transfers,"account_title"=>invoice::find($id)->invoice_code_num]);
    }

    public function employee_transactions($id)
    {
        $query = transaction::where("employee_id",$id);
        $query = Common::user_filter_by_role($query,false,array(),"");
        $transfers = $query->where("transfer_type","expense")->orderBy("id","desc")->paginate($this->pagination_num);
        $employee = employee::find($id);
        return view('transaction.employee_transactions',["transfers"=>$transfers ,"branches"=>Auth::user()->active_branch, "employee"=>$employee]);
    }

    public function employee_salaries_pay_step1($id)
    {
         $employee = employee::find($id);
         $employee_majors = array();
         if($employee  != null)
           $employee_majors = $employee->emplyee_majar_data;
         return view('transaction.employee_pay_salaries_step1',["employee_majors"=>$employee_majors,"emp_id"=>$id]);
    }

    public function employee_salaries_pay(Request $request)
    {
        $trans_type = "expense";
        $extra_salary = $bouns = $discount = array();
        $employee_salary = "";
        $id = $request->emp_id;
        $month = $request->employeemonth;
        $year = $request->employeeyear;
        $emp_major_id = $request->emp_major_id;
        $query = transaction::where("employee_id",$id);
        $query = Common::user_filter_by_role($query,false,array(),"");
        $transfers = $query->where("transfer_type","expense")->orderBy("id","desc")->paginate($this->pagination_num);

        $employee_major = emplyee_major::find($emp_major_id);
        $employe = employee::find($id);
        if($employee_major != null)
        {
            $extra_salary = $employee_major->employeeExtraSalary;

            $bouns = $employee_major->employeeBouns()->whereRaw("month(bonus_date) = ".$month." and year(bonus_date) = ".$year)->get();
            $discount = $employee_major->employeeDiscount()->whereRaw("month(discount_date) = ".$month." and year(discount_date) = ".$year)->get();
            $employee_salary = $employee_major->current_salary;
        }

        return view('transaction.employee_pay_salaries',["transfers"=>$transfers ,"branches"=>Auth::user()->active_branch, "employee"=>$employe,"trans_type"=>$trans_type,"emp_id"=>$id,"month"=>$month , "year"=>$year,"emp_major_id"=>$emp_major_id,"employee_major"=>$employee_major,"extra"=>$extra_salary,"bouns"=>$bouns,"discount"=>$discount,"basic_salary"=>$employee_salary]);
    }


    public function print_transaction($id,$ty)
    {
        $transaction = transaction::find($id);
        $code = "expense_trans";
        if($ty == "income")
          $code = "income_trans";

        $template_data = templates::where("code",$code)->first();
        $replace_tags_body = str_replace("[trans_num]",$transaction->transfer_code_num,$template_data->content);
        if($ty == "income")
           $replace_tags_body = str_replace("[trans_num]",invoice::find($transaction->invoice_id)->invoice_code_num,$template_data->content);
        $replace_tags_body = str_replace("[trans_date]",$transaction->transfer_date,$replace_tags_body);
        $replace_tags_body = str_replace("[perspon_in]",$transaction->person_name ,$replace_tags_body);
        $replace_tags_body = str_replace("[amount_in_character]",$transaction->amount_in_character ,$replace_tags_body);
        $replace_tags_body = str_replace("[desc]",$transaction->transfer_desc ,$replace_tags_body);

        return json_encode(array("sucess"=>true  ,"template_body"=>$replace_tags_body));
    }

    public function sendTransaction($id,$ty)
    {

       $data = json_decode($this->print_transaction($id,$ty));
       $company_settings = settings::find(1);
       $send_email_sender = new \stdClass();
       $send_email_sender->from = $company_settings->company_email;
       $send_email_sender->to = $company_settings->company_email;
       $send_email_sender->cc = $company_settings->company_email;
       $send_email_sender->subject = "Transaction details";
       $send_email_sender->body =  $data->template_body;
       $send_email_sender->view = "mails.invoice_mail_contents";
       Mail::to($request->email_to)->send(new EmailContentSender($send_email_sender));
       return json_encode(array("sucess"=>true));
    }

}
