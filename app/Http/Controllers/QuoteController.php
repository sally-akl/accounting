<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuoteRequest;
use App\customer;
use App\quote;
use App\service;
use App\invoice_item;
use App\classes\Common;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Authenticated;
use Session;
use Auth;
class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pagination_num = 10;
    protected $customers;
    protected $filter_customer;
    protected $quotes;
    protected $services;
    public function __construct()
    {
      Event::listen(Authenticated::class, function ($event) {
        $list =  customer::whereRaw('1 = 1');
        if(!Auth::user()->IsAdmin())
          $list = $list->where("user_id",Auth::user()->id);
        $this->customers = $list->get();


        $list =  quote::where("converted_to_invoce",0);
        if(!Auth::user()->IsAdmin())
          $list = $list->where("user_id",Auth::user()->id);
        $this->quotes = $list->orderBy("id","desc")->paginate($this->pagination_num);

        $list =  service::whereRaw('1 = 1');
        if(!Auth::user()->IsAdmin())
          $list = $list->where("user_id",Auth::user()->id);

        $this->services = $list->get();

        $this->filter_customer = true;
      });

    }

    public function index()
    {
        $this->filter_customer = true;
        //$quotes = quote::where("converted_to_invoce",0)->orderBy("id","desc")->paginate($this->pagination_num);
        return view('quote.index',array("quotes"=>$this->quotes ,"customers"=>$this->customers , "filter_customer"=>$this->filter_customer));

    }

    public function customer($id)
    {
        $this->filter_customer = true;
        $quotes = quote::where("customer_id",$id)->where("converted_to_invoce",0)->orderBy("id","desc")->paginate($this->pagination_num);
        return view('quote.index',array("quotes"=>$quotes ,"customers"=>$this->customers , "filter_customer"=>$this->filter_customer));
    }

    public function all()
    {

        $this->filter_customer = false;
      //  $quotes = quote::where("converted_to_invoce",0)->orderBy("id","desc")->paginate($this->pagination_num);
        return view('quote.index',array("quotes"=>$this->quotes ,"customers"=>$this->customers , "filter_customer"=>$this->filter_customer));

    }

    public function quotes_items($id)
    {
         $quote = quote::find($id);
         //$services = service::all();
         $quote_items = null;

         if($quote != null)
            $quote_items = $quote->services;

        return view('quote.items',array("quote_items"=>$quote_items,"services"=>$this->services ,"quote"=>$quote));
    }

    public function store_quote_items(Request $request)
    {
         $current_index = $request->current_index;

         $old_invoice_items = invoice_item::where('quote_id',$request->invoice_id);
         $old_invoice_items->delete();
         for($i=0;$i<=$current_index;$i++)
         {
             if($request["qty".$i] != "" &&  $request["price".$i] !="")
             {
               $invoice_item = new invoice_item();
               $invoice_item->service_id = $request["service_val".$i];
               $invoice_item->quote_id = $request->invoice_id;
               $invoice_item->qty = $request["qty".$i];
               $invoice_item->price = $request["price".$i];
               $invoice_item->invoice_type="quote";
               $invoice_item->save();
             }

         }
          return redirect('/quote/all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quote.add',array("customers"=>$this->customers));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuoteRequest $request)
    {
         $code = Common::GenerateCode(10,'quote','quote_code_num');
         $quote = new quote();
         $quote->customer_id = $request->customer_name;
         $quote->quote_subject = $request->subject;
         $quote->quote_status = $request->quote_status;
         $quote->quote_date = date("Y-m-d H:i", strtotime($request->quote_date));
         $quote->quote_expire_date = date("Y-m-d H:i", strtotime($request->expire_date));
         $quote->quote_discount_amount = $request->quote_discount;
         $quote->quote_discount_type = $request->quote_discount_type;
         $quote->quote_txt = $request->quote_txt;
         $quote->quote_customer_txt = $request->quote_customer;
         $quote->quote_code_num = $code;
         $quote->converted_to_invoce = 0;
         $quote->user_id = Auth::user()->id;
         $quote->save();
          return redirect('/quote/items/'.$quote->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = quote::find($id);
        return view('quote.update',array("customers"=>$this->customers , "quote"=>$quote));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuoteRequest $request, $id)
    {
        $quote = quote::find($id);
        $quote->customer_id = $request->customer_name;
        $quote->quote_subject = $request->subject;
        $quote->quote_status = $request->quote_status;
        $quote->quote_date = date("Y-m-d H:i", strtotime($request->quote_date));
        $quote->quote_expire_date = date("Y-m-d H:i", strtotime($request->expire_date));
        $quote->quote_discount_amount = $request->quote_discount;
        $quote->quote_discount_type = $request->quote_discount_type;
        $quote->quote_txt = $request->quote_txt;
        $quote->quote_customer_txt = $request->quote_customer;
        $quote->converted_to_invoce = 0;
        $quote->save();
        return redirect('/quote/items/'.$quote->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = quote::find($id);
        $quote->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
}
