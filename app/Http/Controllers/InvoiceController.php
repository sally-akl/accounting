<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\invoice;
use App\customer;
use App\service;
use App\invoice_item;
use App\settings;
use App\classes\Common;
use App\transaction;
use Session;
use App\classes\PdfOperations;
use PDF;
use App\templates;
use App\Mail\EmailContentSender;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Authenticated;
use Validator;
use Auth;
use Lang;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    protected $customers;
    protected $filter_customer;
    protected $services;
    protected $invoice_num;
    protected $total_paid;
    protected $total_unpaid;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $list =  customer::whereRaw('1 = 1');
            $list = Common::user_filter_by_role($list,false,array(),"");
            $this->customers = $list->get();


            $list =  service::select("services.*")->whereRaw('1 = 1');
            $list = Common::user_filter_by_role($list,true,array("categories as c","c.id","category_id"),"services");
            $this->services = $list->get();
            $this->filter_customer = true;

            $list =  invoice::whereRaw('1 = 1');
            $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
            $this->invoice_num = $list->get()->count();
            $this->total_paid =  $list->where("invoice_status","paid")->count();

             $list =  invoice::whereRaw('1 = 1');
             $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
             $this->total_unpaid = $list->where("invoice_status","unpaid")->count();

                               return $next($request);
        });

    }


    public function index()
    {
        $this->filter_customer = true;
        $list =  invoice::select("invoices.*")->whereRaw('1 = 1');
        $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
        $invoices =  $list->orderBy("invoices.id","desc")->paginate($this->pagination_num) ;
        return view('invoice.customer_invoices', array("invoices"=>$invoices , "customers"=>$this->customers, "filter_customer"=>$this->filter_customer,"invoice_num"=>$this->invoice_num,"total_paid"=>$this->total_paid,"total_unpaid"=>$this->total_unpaid));
    }

    public function customer($id)
    {
        $this->filter_customer = true;
        $list =  invoice::select("invoices.*")->where("customer_id",$id)->whereRaw('1 = 1');
        $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
        $invoices = $list->orderBy("invoices.id","desc")->paginate($this->pagination_num);
        return view('invoice.customer_invoices',array("invoices"=>$invoices , "customers"=>$this->customers, "filter_customer"=>$this->filter_customer,"invoice_num"=>$this->invoice_num,"total_paid"=>$this->total_paid,"total_unpaid"=>$this->total_unpaid));
    }

    public function all()
    {
        $this->filter_customer = false;
        $list =  invoice::select("invoices.*")->whereRaw('1 = 1');
        $list = Common::user_filter_by_role($list,true,array("customers as c","c.id","customer_id"),"invoices");
        $invoices =  $list->orderBy("invoices.id","desc")->paginate($this->pagination_num) ;
        return view('invoice.customer_invoices',array("invoices"=>$invoices , "customers"=>$this->customers, "filter_customer"=>$this->filter_customer,"invoice_num"=>$this->invoice_num,"total_paid"=>$this->total_paid,"total_unpaid"=>$this->total_unpaid));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($c,$type)
    {
        Session::put('itype',$type);
        return view('invoice.add',array("customers"=>$this->customers,"c"=>$c,"type"=>$type));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
         $code = Common::GenerateCode(10,'invoice','invoice_code_num');
         $invoice = new invoice();
         $invoice->customer_id = $request->customer_name;
         $invoice->invoice_status = $request->invoice_status;
         $invoice->invoice_date = date("Y-m-d H:i", strtotime($request->invoices_date));
         $invoice->invoice_payment_term = $request->invoice_payment_term;
         $invoice->next_invoice_pay = null;
         if($invoice->invoice_payment_term != "due_on_receipt")
         {
            $invoice->next_invoice_pay = date("Y-m-d", strtotime($request->invoices_date.$invoice->invoice_payment_term." days"));
         }
         $invoice->discount_amount = $request->invoices_discount;
         $invoice->discount_type = $request->invoices_discount_type;
         $invoice->currancy = $request->currency;
         $invoice->invoice_code_num = $code;
         $invoice->user_id = Auth::user()->id;
         $invoice->save();

         return redirect('/invoice/items/'.$invoice->id."/".app()->getLocale()."?branch=".$request->query('branch'));
    }


    public function invoices_items($id)
    {
         $invoice = invoice::find($id);
         $invoice_items = null;
         $currancy = "";

         if($invoice != null)
         {
              $invoice_items = $invoice->services;
              $currancy = Common::getCurrencyText($invoice->currancy);
         }
        return view('invoice.items',array("invoice_items"=>$invoice_items,"services"=>$this->services,"invoice"=>$invoice,"currancy"=>$currancy));
    }

    public function store_invoice_items(Request $request)
    {
         $current_index = $request->current_index;

         $old_invoice_items = invoice_item::where('invoice_id',$request->invoice_id);
         $old_invoice_items->delete();
         for($i=0;$i<=$current_index;$i++)
         {
             if($request["qty".$i] != "" && $request["price".$i] != "")
             {
                 $invoice_item = new invoice_item();
                 $invoice_item->service_id = $request["service_val".$i];
                 $invoice_item->invoice_id = $request->invoice_id;
                 $invoice_item->qty = $request["qty".$i];
                 $invoice_item->price = $request["price".$i];
                 $invoice_item->invoice_type="invoice";
                 $invoice_item->save();

             }

         }

         $redirect = Session::get('itype');
         if($redirect != "toinvoice")
           return redirect('/customer'."/".app()->getLocale()."?branch=".$request->query('branch'));

          return redirect('/invoice/all'."/".app()->getLocale()."?branch=".$request->query('branch'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $invoice = invoice::find($id);
        $company_settings = settings::find(1);
        $transfers = transaction::where("transfer_type","income")->where("invoice_id",$id)->orderBy("id","desc")->get();
        if($request->query("pdf_type") != null)
        {
          $pdf_type = $request->query("pdf_type") ;
          $file_name = $pdf_type == "download"?"invoice #".$invoice->invoice_code_num:"";
          $pdf = new PdfOperations("invoice.invoice_pdf",array("invoice"=>$invoice,"company_settings"=>$company_settings),$pdf_type,$file_name);
          return   $pdf->generate();

        }
        return view('invoice.show',array("invoice"=>$invoice,"company_settings"=>$company_settings,"transfers"=>$transfers));
    }

    public function update_status($id,$ptype,Request $request)
    {
       $invoice = invoice::find($id);
       $invoice->invoice_status = $ptype;
       $invoice->save();
         return redirect("/invoice"."/".$id.'/show'."/".app()->getLocale()."?branch=".$request->query('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $invoice = invoice::find($id);
          $address = "";
          if(customer::find($invoice->customer_id) != null)
               $address = customer::find($invoice->customer_id)->address;
          return view('invoice.update',array("customers"=>$this->customers , "invoice"=>$invoice , "address"=>$address));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, $id)
    {
      $invoice = invoice::find($id);
      $invoice->customer_id = $request->customer_name;
      $invoice->invoice_status = $request->invoice_status;
      $invoice->invoice_date = date("Y-m-d H:i", strtotime($request->invoices_date));
      $invoice->invoice_payment_term = $request->invoice_payment_term;
      $invoice->discount_amount = $request->invoices_discount;
      $invoice->discount_type = $request->invoices_discount_type;
      $invoice->save();

      return redirect('/invoice/items/'.$invoice->id."/".app()->getLocale()."?branch=".$request->query('branch'));
    }


    public function search(Request $request)
    {
        $customer_id  =  $request->customer_val;
        $this->filter_customer = true;
        $from ="";
        $to ="";
        $query = "";

        $request->from = clean($request->from);
        $request->to = clean($request->to);
        if(!empty($request->from) && !empty($request->to))
        {
            $from = date("Y-m-d H:i", strtotime($request->from));
            $to = date("Y-m-d H:i", strtotime($request->to));
        }

        if(!empty($from) && !empty($to))
        {
             $query = invoice::select("invoices.*")->where(function($query2) use ($from,$to){
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
                 $query = invoice::select("invoices.*")->where("invoice_status",$request->invoice_status);
              }
        }

        if(!empty($customer_id))
        {
              if(!empty($query ))
              {
                 $query = $query->where('customer_id', $customer_id);
              }
              else {
                 $query = invoice::select("invoices.*")->where('customer_id', $customer_id);
              }

        }

        $query = Common::user_filter_by_role($query,true,array("customers as c","c.id","customer_id"),"invoices");

        if(!empty($query ))
        {
           $invoices =$query->orderBy("invoices.id","desc")->paginate($this->pagination_num);

        }


        return view('invoice.customer_invoices',array("invoices"=>$invoices , "customers"=>$this->customers, "filter_customer"=>$this->filter_customer,"total_paid"=>$this->total_paid,"total_unpaid"=>$this->total_unpaid,"invoice_num"=>$this->invoice_num));
    }

    public function destroy($id)
    {
        $invoice = invoice::find($id);
        $invoice->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }

    public function getTemplateData($id,$t_type)
    {
        $invoice = invoice::find($id);
        $template_data = templates::where("code",$t_type)->first();
        $replace_tags_body = str_replace("{code}",$invoice->invoice_code_num,$template_data->content);
        $replace_tags_body = str_replace("{create_date}",$invoice->invoice_date,$replace_tags_body);
        $replace_tags_body = str_replace("{amount}",$invoice->getprice() ,$replace_tags_body);
        $replace_tags_body = str_replace("{id}",$invoice->id ,$replace_tags_body);
        return json_encode(array("sucess"=>true ,  "customer_email"=>$invoice->CustomerData->email ,"template_body"=>$replace_tags_body));
    }

    public function sendInvoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'email_to' => 'required|email',
             'email_subject' => 'required',
             'message_content'=>'required|string'
         ]);
        if ($validator->fails())
         return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));

       $company_settings = settings::find(1);
       $send_email_sender = new \stdClass();
       $send_email_sender->from = $company_settings->company_email;
       $send_email_sender->to = $request->email_to;
       $send_email_sender->cc = $request->email_cc;
       $send_email_sender->subject = $request->email_subject;
       $send_email_sender->body = $request->message_content;
       $send_email_sender->view = "mails.invoice_mail_contents";
       Mail::to($request->email_to)->send(new EmailContentSender($send_email_sender));
       return json_encode(array("sucess"=>true));
    }


}
