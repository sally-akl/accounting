<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\invoice;
use App\User;
use App\settings;
use App\Http\Requests\settingRequest;

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
        $latest_tran = transaction::where("transfer_type","income")->orWhere("transfer_type","expense")->orderBy('id', 'desc')->take(6)->get();
        $latest_income = transaction::where("transfer_type","income")->orderBy('id', 'desc')->take(6)->get();
        $latest_outcome = transaction::where("transfer_type","expense")->orderBy('id', 'desc')->take(6)->get();
        $total_invoices = invoice::get()->count();
        $total_users = User::get()->count();
        $total_income =  transaction::where("transfer_type","income")->sum('transfer_amount');
        $total_expense =  transaction::where("transfer_type","expense")->sum('transfer_amount');
        $invoices_due_to_today = invoice::where('next_invoice_pay',date('Y-m-d')." "."00:00")->get();
        return view('home', array("latest_tranation"=>$latest_tran ,"latest_income"=>$latest_income   , "latest_outcome"=>$latest_outcome , "total_invoices"=>$total_invoices,"total_users"=>$total_users,"total_income"=>$total_income,"total_expense"=>$total_expense,"invoices_due_to_today"=>$invoices_due_to_today));
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

        if($request->logo != null)
        {
          $imageName = time().'.'.$request->logo->getClientOriginalExtension();
          $request->logo->move(public_path('images'), $imageName);
          $setting->company_logo =   $imageName;
        }
        $setting->save();
        return redirect('/dashboard');
    }

    public function nopermission()
    {
       return view('nopermission');
    }




}
