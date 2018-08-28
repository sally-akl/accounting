<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\invoice;
use Carbon\Carbon;

class ReportController extends Controller
{
      protected $pagination_num = 10;
      protected $total_income;
      protected $total_expense;
      protected $invoice_by_month_graphic;
      protected $invoices;
      protected $invoice_num;
      protected $total_paid;
      public function __construct()
      {
         $this->total_income =  transaction::where("transfer_type","income")->sum("transfer_amount");
         $this->total_expense = transaction::where("transfer_type","expense")->sum("transfer_amount");
         $this->invoice_by_month_graphic = invoice::where("invoice_items.invoice_type","invoice")->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->selectRaw("
                                date(invoice_date) as category,
                                sum(price) as Income
                            ")
                    ->whereRaw("month(invoice_date)",date("m"))
                ->groupBy('category')->get();



          $this->invoices =  invoice::orderBy("id","desc")->paginate($this->pagination_num);
          $this->invoice_num = invoice::all()->count();
          $this->total_paid =  invoice::where("invoice_items.invoice_type","invoice")->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->selectRaw("
                                 sum(price) as price_total
                             ")->whereRaw("month(invoice_date)",date("m"))->get();


      }
      public function transaction($trans_type)
      {
           $transfers = transaction::where("transfer_type",$trans_type)->orderBy("id","desc")->paginate($this->pagination_num);
           $total = transaction::where("transfer_type",$trans_type)->sum("transfer_amount");
           $total_month = transaction::where("transfer_type",$trans_type)->whereRaw("month(transfer_date)",date("m"))->sum("transfer_amount");
           $total_week = transaction::where("transfer_type",$trans_type)->whereBetween('transfer_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum("transfer_amount");
           $transaction_by_month_graphic = transaction::where("transfer_type",$trans_type)->selectRaw("
                                date(transfer_date) as category,
                                sum(transfer_amount) as Income
                                ")
                        ->whereRaw("month(transfer_date)",date("m"))
                    ->groupBy('category')->get();


           return view('reports.income',["transfers"=>$transfers,"total"=>$total,"total_month"=>$total_month,"total_week"=>$total_week,"transaction_by_month_graphic"=> json_encode($transaction_by_month_graphic) ,"trans_type"=>$trans_type]);
      }
      public function invoices()
      {
           return view('reports.invoices',["invoices"=>$this->invoices,"invoice_by_month_graphic"=> json_encode($this->invoice_by_month_graphic),"invoice_num"=>$this->invoice_num,"total_paid"=>$this->total_paid]);
      }



      public function filterTransactionByDate($trans_type)
      {
          $transfers = transaction::where("transfer_type","!=","transfer")->orderBy("id","desc")->paginate($this->pagination_num);
          return view('reports.filter_by_date',["transfers"=>$transfers,"trans_type"=>$trans_type,"total_income"=>$this->total_income,"total_expense"=>$this->total_expense]);
      }

      public function search(Request $request)
      {
           $trans_type = $request->transfer_type;
           $from = date("Y-m-d H:i", strtotime($request->transfer_from));
           $to = date("Y-m-d H:i", strtotime($request->transfer_to));


           if(!empty($from) && !empty($to) && isset($request->transfer_to) && !empty($request->transfer_to))
           {
                $transfers = transaction::where(function($query2) use ($from,$to){
                            $query2->whereBetween('transfer_date',array($from,$to));
                })->orderBy("id","desc")->paginate($this->pagination_num);
           }
           else if(!empty($from))
           {
                $transfers = transaction::where('transfer_date', $from )->orderBy("id","desc")->paginate($this->pagination_num);
           }
           return view('reports.filter_by_date',["transfers"=>$transfers,"trans_type"=>$trans_type,"total_income"=>$this->total_income,"total_expense"=>$this->total_expense]);
      }

      public function invoiceSearch(Request $request)
      {
          $from = date("Y-m-d H:i", strtotime($request->transfer_from));
          $to = date("Y-m-d H:i", strtotime($request->transfer_to));


          if(!empty($from) && !empty($to))
          {
               $this->invoices = invoice::where(function($query2) use ($from,$to){
                           $query2->whereBetween('invoice_date',array($from,$to));
               })->orderBy("id","desc")->paginate($this->pagination_num);
          }

          return view('reports.invoices',["invoices"=>$this->invoices,"invoice_by_month_graphic"=> json_encode($this->invoice_by_month_graphic),"invoice_num"=>$this->invoice_num,"total_paid"=>$this->total_paid ]);

      }

}
