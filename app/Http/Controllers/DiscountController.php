<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\discount;
use App\emplyee_major;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\DiscountEditRequest;
use Session;
use App\classes\Common;
use Auth;

class DiscountController extends Controller
{

      protected $pagination_num = 10;
      public function index()
      {
           $discount = Common::CommonList('discount',$this->pagination_num ) ;
           $employee_major = emplyee_major::all();
           return view('discount.index',compact('discount','employee_major'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
          $employee_major = emplyee_major::all();
          return view('discount.add',compact('employee_major'));
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(DiscountRequest $request)
      {
            $discount = new discount();
            $discount->emp_major_id = $request->emp_m_id;
            $discount->discount_date = date("Y-m-d H:i", strtotime($request->bdate));
            $discount->discount_amount = $request->amount;
            $discount->user_id = Auth::user()->id;
            $discount->save();
            return redirect('/discount')->with("message",trans('app.add_sucessfully'));
      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function show($id)
      {
          $discount = discount::find($id);
          return view('discount.show',compact('bouns'));
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function edit($id)
      {
            $discount = discount::find($id);
            $employee_major = emplyee_major::all();
            return view('discount.update',compact('discount','employee_major'));
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function update(DiscountEditRequest $request, $id)
      {
           $discount = discount::find($id);
           $discount->discount_amount = $request->amount;
           $discount->save();
           return redirect('/discount')->with("message",trans('app.update_sucessfully'));
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
           $discount = discount::find($id);
           $discount->delete();
           Session::put('message', trans('app.delete_sucessfully'));
           return json_encode(array("sucess"=>true));
      }

      public function search(Request $request)
      {
           $search_title =  $request->emp_m_id;
           $employee_major = emplyee_major::all();
           $discount = discount::where('emp_major_id','=',$search_title)->orderBy("id","desc")->paginate($this->pagination_num);
           return view('discount.index',compact('discount','employee_major'));
      }
}
