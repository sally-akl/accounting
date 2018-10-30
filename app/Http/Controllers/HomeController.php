<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\invoice;
use App\User;
use App\settings;
use App\currency_settings;
use App\Http\Requests\settingRequest;
use Illuminate\Support\Facades\DB;
use App\classes\Common;
use Auth;
use Lang;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      /*  $currency_settings = currency_settings::where('currency_date',date("Y-m-d"))->first();
        if($currency_settings == null)
        {
            $gp_str = Auth::user()->currency."_"."EGP";
            $egp_val = Common::getCurrancyRate($gp_str)->$gp_str->val;

            $sar_str = Auth::user()->currency."_"."SAR";
            $sar_val = Common::getCurrancyRate($sar_str)->$sar_str->val;

            $usd_str = Auth::user()->currency."_"."USD";
            $usd_val = Common::getCurrancyRate($usd_str)->$usd_str->val;
            $currency_settings = new currency_settings();

            $currency_settings->currency_date = date("Y-m-d");
            $currency_settings->current_currency = Auth::user()->currency;
            $currency_settings->EGP = $egp_val;
            $currency_settings->SAR = $sar_val;
            $currency_settings->USD = $usd_val;
            $currency_settings->save();
        }
        */

        $list = transaction::whereRaw('1 = 1');
        $list = Common::user_filter_by_role($list,false,array(),"");
        $latest_tran = $list->whereIn("transfer_type",array("income","expense"))->orderBy('id', 'desc')->take(3)->get();

        $list = transaction::where("transfer_type","income");
        $list = Common::user_filter_by_role($list,false,array(),"");
        $latest_income = $list->orderBy('id', 'desc')->take(3)->get();

        $list = transaction::where("transfer_type","expense");
        $list = Common::user_filter_by_role($list,false,array(),"");
        $latest_outcome = $list->orderBy('id', 'desc')->take(3)->get();

        $list = invoice::select("invoices.*")->whereRaw('1 = 1');
        $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
        $total_invoices = $list->get()->count();

        $total_users = User::get()->count();

        $list =  transaction::where("transfer_type","income");
        $list = Common::user_filter_by_role($list,false,array(),"");
        $total_income = $list->sum('converted_transfer_amount');

        $list =  transaction::where("transfer_type","expense");
        $list = Common::user_filter_by_role($list,false,array(),"");
        $total_expense = $list->sum('converted_transfer_amount');

        $invoices_due_to_today = invoice::where('next_invoice_pay',date('Y-m-d')." "."00:00")->get();

        $current_month = date("m");
        $qu = $qu2 ="1 = 1";
        if(!Auth::user()->IsAdmin())
        {
            $qu = $qu2 =  "incomeTb.user_id=".Auth::user()->id;
            if(Auth::user()->hasChildRoles())
            {
                 $qu = '(incomeTb.`user_id` = '.Auth::user()->id.' or incomeTb.`user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.'))) and incomeTb.branch_id  in ('.implode(",",Auth::user()->branches).')';
                 $qu2 = '(expenseTb.`user_id` = '.Auth::user()->id.' or expenseTb.`user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.'))) and expenseTb.branch_id  in ('.implode(",",Auth::user()->branches).')';
            }

        }

        $expense_income_chart = DB::select(DB::raw('select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income  END as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense ,   incomeTb.Date as category , incomeTb.user_id , incomeTb.branch_id

                                                    from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="income" group by Date , user_id , branch_id ) as incomeTb left join
                                                         (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id  , branch_id from transactions where transfer_type="expense" group by Date , user_id , branch_id) as expenseTb
                                                         on incomeTb.Date = expenseTb.Date  where month(incomeTb.Date) = "'.$current_month.'" and '.$qu.'


                                                         UNION

                                                         select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income END  as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense, expenseTb.Date as category , expenseTb.user_id , expenseTb.branch_id
                                                         from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="income" group by Date , user_id, branch_id  ) as incomeTb right join
                                                         (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="expense" group by Date , user_id , branch_id) as expenseTb
                                                         on incomeTb.Date = expenseTb.Date where month(expenseTb.Date) = "'.$current_month.'" and '.$qu2.'
                                                    '));

                                                    if(!Auth::user()->IsAdmin())
                                                    {
                                                        $qu =   "user_id=".Auth::user()->id;
                                                        if(Auth::user()->hasChildRoles())
                                                        {
                                                             $qu = '(`user_id` = '.Auth::user()->id.' or `user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.'))) and branch_id  in ('.implode(",",Auth::user()->branches).')';
                                                        }

                                                    }

        $expense_income_circle_query =  DB::select(DB::raw('select sum(converted_transfer_amount) as income from transactions where transfer_type="income" and '.$qu.' UNION  select sum(converted_transfer_amount) as expense from transactions where transfer_type="expense" and '.$qu));
        $expense_income_circle = array();

        $expense_income_circle[] = array("label"=>"Income" , "value"=>0);
        $expense_income_circle[] = array("label"=>"Expense" , "value"=>0);
        $currency = \App\classes\Common::getCurrencyText(Auth::user()->currency);
        if(count($expense_income_circle_query) == 2)
        {
          $expense_income_circle = array();
          $expense_income_circle[] = array("label"=>"Income" , "value"=>$expense_income_circle_query[0]->income." ".$currency);
          $expense_income_circle[] = array("label"=>"Expense" , "value"=>$expense_income_circle_query[1]->income." ".$currency);
        }


        return view('home', array("latest_tranation"=>$latest_tran ,"latest_income"=>$latest_income   , "latest_outcome"=>$latest_outcome , "total_invoices"=>$total_invoices,"total_users"=>$total_users,"total_income"=>$total_income,"total_expense"=>$total_expense,"invoices_due_to_today"=>$invoices_due_to_today,"expense_income_chart"=>json_encode($expense_income_chart),"expense_income_circle"=>json_encode($expense_income_circle)));
    }


    public function getSetting($id)
    {
        $setting = settings::find($id);
        return view('setting',compact('setting'));
    }

    public function update_setting($id , settingRequest $request)
    {
        $setting = settings::find($id);
        $setting->company_name =  $request->name;
        $setting->company_address =  $request->address;
        $setting->company_email = $request->email;
        $setting->salary_type = "monthly";
        $setting->currency = $request->currency;

        if($request->logo != null)
        {
          $imageName = time().'.'.$request->logo->getClientOriginalExtension();
          $request->logo->move(public_path('images'), $imageName);
          $setting->company_logo =   $imageName;
        }
        $setting->save();
        return redirect('/dashboard'."?lang=".app()->getLocale()."&branch=".$request->query('branch'));
    }
    public function nopermission()
    {
       return view('nopermission');
    }





}
