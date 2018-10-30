<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CurrencyRequest;
use App\currency_settings;
use App\classes\Common;
use Session;
use Auth;
class CurrencySettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pagination_num = 5;
    public function index()
    {
         $currency_settings =  currency_settings::orderBy("id","desc")->paginate($this->pagination_num);
         return view('currency_settings.index',compact('currency_settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency_setting = currency_settings::find($id);
        return view('currency_settings.update',compact('currency_setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request,$id)
    {
          $currency_setting = currency_settings::find($id);
          $currency_setting->EGP = $request->EGP;
          $currency_setting->SAR = $request->SAR;
          $currency_setting->USD = $request->USD;
          $currency_setting->save();
          return redirect('/currency'."/".app()->getLocale())->with("message",trans('app.update_sucessfully'));
    }

    public function search(Request $request)
    {
         $search_date =  clean($request->search_date);
         $query  =  currency_settings::whereRaw('1 = 1');
         if(!empty($search_date))
           $query = $query->where('currency_date','=',$search_date);

         $currency_settings = $query->orderBy("id","desc")->paginate($this->pagination_num);
         return view('currency_settings.index',compact('currency_settings'));
    }


}
