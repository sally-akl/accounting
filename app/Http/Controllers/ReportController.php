<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\expense_type;
use App\employee;
use App\category;
use App\classes\Common;
use App\currency_settings;
use Auth;
class ReportController extends Controller
{
      protected $pagination_num = 10;
      protected $total_income;
      protected $total_expense;
      protected $invoice_by_month_graphic;
      protected $invoices;
      protected $invoice_num;
      protected $total_paid;
      protected $expense_type;
      protected $employee;
      protected $convert_by_date;
      protected $categories;
      public function __construct()
      {
          $this->middleware(function ($request, $next) {


             $list = transaction::where("transfer_type","income");
             $list = Common::user_filter_by_role($list,false,array(),"");
             $this->total_income = $list->sum("converted_transfer_amount");

             $list = transaction::where("transfer_type","expense");
             $list = Common::user_filter_by_role($list,false,array(),"");
             $this->total_expense = $list->sum("converted_transfer_amount");


          /*   $list =  invoice::whereRaw('1 = 1');
             $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
             $this->invoice_by_month_graphic = $list->where("invoice_items.invoice_type","invoice")->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->selectRaw("
                                    date(invoice_date) as category,
                                    sum(price) as Income
                                ")
                        ->whereRaw("month(invoice_date)=".date("m"))
                    ->groupBy('category')->get();
                    */


            $list = transaction::where("transfer_type","income");
            $list = Common::user_filter_by_role($list,false,array(),"");
            $this->invoice_by_month_graphic = $list->selectRaw("
                                         date(transfer_date) as category,
                                         sum(converted_transfer_amount) as Income
                                         ")
                                 ->whereRaw("month(transfer_date)=".date("m"))
                             ->groupBy('category')->get();


              $list =  invoice::select("invoices.*")->whereRaw('1 = 1');
              $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
              $this->invoices =  $list->orderBy("invoices.id","desc")->paginate($this->pagination_num);

              $list =  invoice::whereRaw('1 = 1');
              $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
              if(!Auth::user()->IsAdmin())
                $this->invoice_num = $list->get()->count();
              else
                $this->invoice_num = invoice::all()->count();

              $list =  invoice::whereRaw('1 = 1');
              $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");

            /*  $this->total_paid =  $list->where("invoice_items.invoice_type","invoice")->where("invoice_status","paid")->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->selectRaw("
                                     sum(price) as price_total
                                 ")->whereRaw("month(invoice_date)",date("m"))->get();

                                 */

               $list =  transaction::where("transfer_type","income");
               $list = Common::user_filter_by_role($list,false,array(),"");
               $this->total_paid = $list->sum('converted_transfer_amount');


              $this->expense_type = expense_type::all();
              $list =  employee::whereRaw('1 = 1');
              $list = Common::user_filter_by_role($list,false,array(),"");
              $this->employee =$list->get();


              $list = category::whereRaw('1 = 1');
              $list = Common::user_filter_by_role($list,false,array(),"");
              $this->categories = $list->get();


          return $next($request);

      });



      }


      public function transaction($trans_type)
      {
           $list = transaction::where("transfer_type",$trans_type);
           $list = Common::user_filter_by_role($list,false,array(),"");
           $transfers    = $list->orderBy("id","desc")->paginate($this->pagination_num);

           $list = transaction::where("transfer_type",$trans_type);
           $list = Common::user_filter_by_role($list,false,array(),"");
           $total = $list->sum("converted_transfer_amount");

           $list = transaction::where("transfer_type",$trans_type)->whereRaw("month(transfer_date)=".date("m"));
           $list = Common::user_filter_by_role($list,false,array(),"");
           $total_month = $list->sum("converted_transfer_amount");


           $list = transaction::where("transfer_type",$trans_type)->whereBetween('transfer_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
           $list = Common::user_filter_by_role($list,false,array(),"");
           $total_week = $list->sum("converted_transfer_amount");


           $list = transaction::where("transfer_type",$trans_type);
           $list = Common::user_filter_by_role($list,false,array(),"");
           $transaction_by_month_graphic = $list->selectRaw("
                                date(transfer_date) as category,
                                sum(converted_transfer_amount) as Income
                                ")
                        ->whereRaw("month(transfer_date)=".date("m"))
                    ->groupBy('category')->get();


           return view('reports.income',["transfers"=>$transfers,"total"=>$total,"total_month"=>$total_month,"total_week"=>$total_week,"transaction_by_month_graphic"=> json_encode($transaction_by_month_graphic) ,"trans_type"=>$trans_type]);
      }
      public function invoices()
      {
           return view('reports.invoices',["invoices"=>$this->invoices,"invoice_by_month_graphic"=> json_encode($this->invoice_by_month_graphic),"invoice_num"=>$this->invoice_num,"total_paid"=>$this->total_paid]);
      }



      public function filterTransactionByDate($trans_type)
      {
          $list = transaction::where("transfer_type","!=","transfer");
          $list = Common::user_filter_by_role($list,false,array(),"");
          $transfers = $list->orderBy("id","desc")->paginate($this->pagination_num);
          $qu = $qu2 =  "1=1";
          if(!Auth::user()->IsAdmin())
          {
              if(Auth::user()->hasChildRoles())
              {
                $qu = '(incomeTb.`user_id` = '.Auth::user()->id.' or incomeTb.`user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.'))) and incomeTb.branch_id  in ('.implode(",",Auth::user()->branches).')';
                $qu2 = '(expenseTb.`user_id` = '.Auth::user()->id.' or expenseTb.`user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.'))) and expenseTb.branch_id  in ('.implode(",",Auth::user()->branches).')';
              }
              else {
                  $qu = $qu2 =  "incomeTb.user_id=".Auth::user()->id;
              }

          }


          $expense_income_chart = DB::select(DB::raw('select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income  END as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense ,   incomeTb.Date as category , incomeTb.user_id , incomeTb.branch_id

                                                      from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date ,  user_id , branch_id from transactions where transfer_type="income" group by Date, user_id , branch_id   ) as incomeTb left join
                                                           (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date ,  user_id , branch_id from transactions where transfer_type="expense" group by Date, user_id , branch_id) as expenseTb
                                                           on incomeTb.Date = expenseTb.Date where '.$qu.'


                                                           UNION

                                                           select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income END  as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense, expenseTb.Date as category , expenseTb.user_id ,  expenseTb.branch_id
                                                           from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="income" group by Date, user_id , branch_id ) as incomeTb right join
                                                           (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="expense" group by Date, user_id , branch_id) as expenseTb
                                                           on incomeTb.Date = expenseTb.Date where '.$qu2.'
                                                      '));



          return view('reports.filter_by_date',["transfers"=>$transfers,"trans_type"=>$trans_type,"total_income"=>$this->total_income,"total_expense"=>$this->total_expense,"expense_income_chart"=>json_encode($expense_income_chart)]);
      }

      public function search(Request $request)
      {
           $trans_type = $request->transfer_type;
           $from = "";
           $to = "";

           $request->transfer_from = clean($request->transfer_from);
           $request->transfer_to = clean($request->transfer_to);

           if(!empty($request->transfer_from))
             $from = date("Y-m-d H:i", strtotime($request->transfer_from));
           if(!empty($request->transfer_to))
             $to = date("Y-m-d H:i", strtotime($request->transfer_to));


            $list = transaction::whereRaw('1 = 1');
            $list = Common::user_filter_by_role($list,false,array(),"");
            $qu = $qu2 =  "1=1";
              if(!Auth::user()->IsAdmin())
              {
                  if(Auth::user()->hasChildRoles())
                  {
                    $qu = '(incomeTb.`user_id` = '.Auth::user()->id.' or incomeTb.`user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.'))) and incomeTb.branch_id  in ('.implode(",",Auth::user()->branches).')';
                    $qu2 = '(expenseTb.`user_id` = '.Auth::user()->id.' or expenseTb.`user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.'))) and expenseTb.branch_id  in ('.implode(",",Auth::user()->branches).')';
                  }
                  else {
                      $qu = $qu2 =  "incomeTb.user_id=".Auth::user()->id;
                  }
              }


            $expense_income_chart = DB::select(DB::raw('select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income  END as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense ,   incomeTb.Date as category , incomeTb.user_id , incomeTb.branch_id

                                                        from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="income" group by Date , user_id , branch_id ) as incomeTb left join
                                                             (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="expense" group by Date , user_id , branch_id) as expenseTb
                                                             on incomeTb.Date = expenseTb.Date  where '.$qu.'


                                                             UNION

                                                             select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income END  as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense, expenseTb.Date as category , expenseTb.user_id , expenseTb.branch_id
                                                             from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="income" group by Date, user_id , branch_id ) as incomeTb right join
                                                             (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="expense" group by Date, user_id , branch_id) as expenseTb
                                                             on incomeTb.Date = expenseTb.Date where '.$qu2.'
                                                        '));

           if(!empty($from) && !empty($to) && isset($request->transfer_to) && !empty($request->transfer_to))
           {
                $list = transaction::where(function($query2) use ($from,$to){
                            $query2->whereBetween('transfer_date',array($from,$to));
                });
                $list = Common::user_filter_by_role($list,false,array(),"");
                $expense_income_chart = DB::select(DB::raw('select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income  END as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense ,   incomeTb.Date as category , incomeTb.user_id , incomeTb.branch_id


                                                            from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id  from transactions where transfer_type="income" group by Date , user_id , branch_id  ) as incomeTb left join
                                                                 (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id , branch_id  from transactions where transfer_type="expense" group by Date , user_id , branch_id ) as expenseTb
                                                                 on incomeTb.Date = expenseTb.Date where (incomeTb.Date between  "'.$from.'" and  "'.$to.'") and '.$qu.'


                                                                 UNION

                                                                 select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income END  as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense, expenseTb.Date as category , expenseTb.user_id , expenseTb.branch_id
                                                                 from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id  from transactions where transfer_type="income" group by Date , user_id , branch_id ) as incomeTb right join
                                                                 (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id , branch_id  from transactions where transfer_type="expense" group by Date , user_id , branch_id ) as expenseTb
                                                                 on incomeTb.Date = expenseTb.Date where (expenseTb.Date between  "'.$from.'" and  "'.$to.'") and '.$qu2.'
                                                            '));



           }
           else if(!empty($from))
           {
                $list = transaction::where('transfer_date', $from );
                $list = Common::user_filter_by_role($list,false,array(),"");
                $expense_income_chart = DB::select(DB::raw('select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income  END as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense ,   incomeTb.Date as category , incomeTb.user_id , incomeTb.branch_id

                                                            from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="income" group by Date , user_id , branch_id  ) as incomeTb left join
                                                                 (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="expense" group by Date , user_id , branch_id) as expenseTb
                                                                 on incomeTb.Date = expenseTb.Date where incomeTb.Date = "'.$from.'" and '.$qu.'


                                                                 UNION

                                                                 select CASE WHEN incomeTb.income IS NULL THEN 0 ELSE incomeTb.income END  as Income , CASE WHEN expenseTb.expense IS NULL THEN 0 ELSE expenseTb.expense END as Expense, expenseTb.Date as category , expenseTb.user_id , expenseTb.branch_id
                                                                 from (select sum(converted_transfer_amount) as income , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="income" group by Date , user_id , branch_id ) as incomeTb right join
                                                                 (select sum(converted_transfer_amount) as expense , CAST( transfer_date AS date ) as Date , user_id , branch_id from transactions where transfer_type="expense" group by Date , user_id , branch_id) as expenseTb
                                                                 on incomeTb.Date = expenseTb.Date where expenseTb.Date = "'.$from.'" and '.$qu2.'
                                                            '));
           }

           $transfers = $list->orderBy("id","desc")->paginate($this->pagination_num);



           return view('reports.filter_by_date',["transfers"=>$transfers,"trans_type"=>$trans_type,"total_income"=>$this->total_income,"total_expense"=>$this->total_expense,"expense_income_chart"=>json_encode($expense_income_chart)]);
      }

      public function invoiceSearch(Request $request)
      {
          $from ="";
          $to ="";
          $query = "";

          $request->transfer_from = clean($request->transfer_from);
          $request->transfer_to = clean($request->transfer_to);

          $query = invoice::select("invoices.*")->whereRaw('1 = 1');
          if(!empty($request->transfer_from) && !empty($request->transfer_to))
          {
            $from = date("Y-m-d H:i", strtotime($request->transfer_from));
            $to = date("Y-m-d H:i", strtotime($request->transfer_to));
          }


          if(!empty($from) && !empty($to))
          {
               $query = invoice::where(function($query2) use ($from,$to){
                           $query2->whereBetween('invoice_date',array($from,$to));
               });
          }
          if($request->invoice_status !="" )
          {
                if(!empty($query ))
                {
                   $query = $query->where("invoice_status",$request->invoice_status);
                }
                else {
                   $query = invoice::where("invoice_status",$request->invoice_status);
                }
          }
          $query = Common::user_filter_by_role($query,true,array("customers as c","c.id","customer_id"),"invoices");

          if(!empty($query ))
          {
             $this->invoices = $query->orderBy("invoices.id","desc")->paginate($this->pagination_num);
          }

          return view('reports.invoices',["invoices"=>$this->invoices,"invoice_by_month_graphic"=> json_encode($this->invoice_by_month_graphic),"invoice_num"=>$this->invoice_num,"total_paid"=>$this->total_paid ]);

      }

      public function category()
      {
          $query = transaction::where("transfer_type","expense");
          $query = Common::user_filter_by_role($query,false,array(),"");
          $transfers = $query->orderBy("id","desc")->paginate($this->pagination_num);
          return view('reports.filter_by_category',["expense_type"=>$this->expense_type , "employee"=>$this->employee , "transfers"=>$transfers]);
      }

      public function categorysearch(Request $request)
      {
          $from = "";
          $to = "";
          $query = transaction::where("transfer_type","expense");

          $request->transfer_from = clean($request->transfer_from);
          $request->transfer_to = clean($request->transfer_to);

          if(!empty($request->transfer_from))
            $from = date("Y-m-d H:i", strtotime($request->transfer_from));
          if(!empty($request->transfer_to))
            $to = date("Y-m-d H:i", strtotime($request->transfer_to));

            if(!empty($from) && !empty($to))
            {
                 $query = $query->where(function($query2) use ($from,$to){
                             $query2->whereBetween('transfer_date',array($from,$to));
                 });
            }
            if($request->expense_val != "")
            {

                $query = $query->where("expense_type_id",$request->expense_val);
            }
            $query = Common::user_filter_by_role($query,false,array(),"");

            $transfers = $query->orderBy("id","desc")->paginate($this->pagination_num);
            return view('reports.filter_by_category',["expense_type"=>$this->expense_type , "employee"=>$this->employee , "transfers"=>$transfers]);



      }

      public function employee_salary(Request $request)
      {
            $from = "";
            $to = "";
            $employee_id = $request->employee;
            $query = transaction::where("transfer_type","expense")->where("expense_type_id",5);

            $request->transfer_from = clean($request->transfer_from);
            $request->transfer_to = clean($request->transfer_to);

            if(!empty($request->transfer_from))
              $from = date("Y-m-d H:i", strtotime($request->transfer_from));
            if(!empty($request->transfer_to))
              $to = date("Y-m-d H:i", strtotime($request->transfer_to));

             if(!empty($from) && !empty($to))
             {
                $query = $query->where(function($query2) use ($from,$to){
                               $query2->whereBetween('transfer_date',array($from,$to));
                });
             }
             if($request->employee != 0)
               $query = $query->where("employee_id",$employee_id);

            $transfers = $query->orderBy("id","desc")->paginate($this->pagination_num);
            return view('reports.filter_salary',["employee"=>$this->employee , "transfers"=>$transfers,"employee_id"=>$employee_id]);
     }

     public function employee_income()
     {
         return view('reports.employee_income',["employee"=>$this->employee , "categories"=>$this->categories]);
     }

     public function employee_income_search(Request $request)
     {
           $from = "";
           $to = "";
           $request->transfer_from = clean($request->transfer_from);
           $request->transfer_to = clean($request->transfer_to);
           
           $query =  invoice::whereRaw('1 = 1');
           if(!empty($request->transfer_from))
             $from = date("Y-m-d H:i", strtotime($request->transfer_from));
           if(!empty($request->transfer_to))
             $to = date("Y-m-d H:i", strtotime($request->transfer_to));

           if(!empty($from) && !empty($to))
           {
                $query = $query->where(function($query2) use ($from,$to){
                               $query2->whereBetween('invoice_date',array($from,$to));
                });
           }

           if(($request->cate == 0 && $request->employee != 0) || ($request->cate != 0 && $request->employee != 0))
           {
               $emploee = employee::find($request->employee);
               if($emploee != null)
                 $query = $query->where('user_id',$emploee->related_user_id);
           }

           if($request->cate != 0 && $request->employee == 0)
           {
               $query = $query->whereRaw('user_id = (select employees.related_user_id from categories join  major on categories.id = major.category_id  join  emplyee_majors on  emplyee_majors.major_id = major.id join employees on employees.id =emplyee_majors.emplyee_id  where categories.id ='.$request->cate.' )');
           }

           $invoices = $query->orderBy("id","desc")->paginate($this->pagination_num);
           return view('reports.employee_income',["employee"=>$this->employee , "categories"=>$this->categories,"invoices"=>$invoices]);

     }

}
