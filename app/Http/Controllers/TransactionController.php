<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\account;
use App\invoice;
use App\expense_type;
use App\Http\Requests\TransactionRequest;
use App\classes\Common;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Authenticated;
use Session;
use Auth;
class TransactionController extends Controller
{

    protected $pagination_num = 10;
    protected $accounts;
    protected $invoices;
    protected $expense_type;
    public function __construct()
    {
        Event::listen(Authenticated::class, function ($event) {
          $list =  account::whereRaw('1 = 1');
          if(!Auth::user()->IsAdmin())
            $list = $list->where("user_id",Auth::user()->id);
          $this->accounts = $list->get();

          $list =  invoice::whereRaw('1 = 1');
          if(!Auth::user()->IsAdmin())
            $list = $list->where("user_id",Auth::user()->id);
          $this->invoices = $list->get();

          $list =  expense_type::whereRaw('1 = 1');
          if(!Auth::user()->IsAdmin())
            $list = $list->where("user_id",Auth::user()->id);
          $this->expense_type = $list->get();

        });
    }

    public function index($trans_type)
    {
        Session::put('filtered_invoice',null);

        $list =  transaction::where("transfer_type",$trans_type);
        if(!Auth::user()->IsAdmin())
          $list = $list->where("user_id",Auth::user()->id);

        $transfers = $list->orderBy("id","desc")->paginate($this->pagination_num);
        return view('transaction.index',["transfers"=>$transfers , "trans_type"=>$trans_type , "accounts"=>$this->accounts,"invoices"=>$this->invoices , "expense_type"=>$this->expense_type]);
    }

    public function invoices_income($id)
    {
        Session::put('filtered_invoice',$id);
        $list =  transaction::where("transfer_type","income")->where("invoice_id",$id);
        if(!Auth::user()->IsAdmin())
          $list = $list->where("user_id",Auth::user()->id);

        $transfers = $list->orderBy("id","desc")->paginate($this->pagination_num);
        return view('transaction.index',["transfers"=>$transfers , "trans_type"=>"income" , "accounts"=>$this->accounts,"invoices"=>$this->invoices , "expense_type"=>$this->expense_type]);
    }

    public function create($trans_type,Request $request)
    {
        $action = "";
        if($request->query("action") != null)
          $action = $request->query("action");

        if($request->query("invoice_id") != null)
          Session::put('filtered_invoice',$request->query("invoice_id"));
        return view('transaction.add',  ["trans_type"=>$trans_type , "accounts"=>$this->accounts,"invoices"=>$this->invoices , "expense_type"=>$this->expense_type,"action"=>$action]);
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
         $transaction->account_to_id = $request->to_account;
         $transaction->transfer_code_num = $code;
         $transaction->transfer_date =  date("Y-m-d H:i", strtotime($request->transfer_d));
         $transaction->transfer_desc = $request->desc;
         $transaction->transfer_amount = $request->amount;
         $transaction->transfer_type = $request->transfer_type;
         if($request->transfer_type == "income")
         {
            $transaction->invoice_id = $request->invoice_val;
         }
         else if($request->transfer_type == "expense")
         {
            $transaction->expense_type_id = $request->expense_val;
         }
         else if($request->transfer_type == "transfer")
         {
            $transaction->account_from_id = $request->account_from;
         }
         $transaction->user_id = Auth::user()->id;
         $transaction->save();

         $filtered_invoice_id = Session::get('filtered_invoice');

         if($filtered_invoice_id == null)
           return redirect('/transactions/'.$request->transfer_type)->with("message",trans('app.add_sucessfully'));
        else if($filtered_invoice_id != null && $request->action_type == "add_payment")
           return redirect("invoice/".$transaction->invoice_id."/show");

           return redirect('/transactions/income/'.$filtered_invoice_id)->with("message",trans('app.add_sucessfully'));
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
         $trans_type = $request->transfer_type;
         $from = date("Y-m-d H:i", strtotime($request->transfer_from));
         $to = date("Y-m-d H:i", strtotime($request->transfer_to));
         $to_account = $request->to_account;
         $query = transaction::where('account_to_id', $to_account);
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
              $query = $query->where('invoice_id',$invoice_val );
              break;
            case 'expense':
              $expense_val = $request->expense_val;
              $query = $query->where('expense_type_id',$expense_val );
              break;
            case 'transfer':
              $account_from = $request->account_from;
              $query = $query->where('account_from_id',$account_from );
              break;

         }
         $transfers = $query->orderBy("id","desc")->paginate($this->pagination_num);
         return view('transaction.index',["transfers"=>$transfers ,"trans_type"=>$trans_type,"accounts"=>$this->accounts,"invoices"=>$this->invoices , "expense_type"=>$this->expense_type]);
    }

    public function balance()
    {
        return view('transaction.balance',["accounts"=>$this->accounts]);
    }
    public function balanceTransactionDetails($id)
    {
         $transfers = transaction::where("account_to_id",$id)->orderBy("id","desc")->paginate($this->pagination_num);
         return view('transaction.balance_transfer_details',["transfers"=>$transfers,"account_title"=>account::find($id)->bank_name]);
    }
    public function invoices()
    {
       $list =  invoice::where("invoice_status","paid");
       if(!Auth::user()->IsAdmin())
         $list = $list->where("user_id",Auth::user()->id);

        $invoices = $list->orderBy("id","desc")->paginate($this->pagination_num);
        return view('transaction.invoices',compact('invoices'));
    }
    public function invoicesDetails($id)
    {
      $transfers = transaction::where("invoice_id",$id)->orderBy("id","desc")->paginate($this->pagination_num);
      return view('transaction.balance_transfer_details',["transfers"=>$transfers,"account_title"=>invoice::find($id)->invoice_code_num]);
    }


}
