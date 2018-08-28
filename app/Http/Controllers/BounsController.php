<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bouns;
use App\emplyee_major;
use App\Http\Requests\BounsRequest;
use App\Http\Requests\BounsEditRequest;
use Session;
use App\classes\Common;
use Auth;
class BounsController extends Controller
{
      protected $pagination_num = 10;
      public function index()
      {
           $bouns =  Common::CommonList('bouns',$this->pagination_num ) ;
           $employee_major = emplyee_major::all();
           return view('bouns.index',compact('bouns','employee_major'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
          $employee_major = emplyee_major::all();
          return view('bouns.add',compact('employee_major'));
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(BounsRequest $request)
      {
            $bouns = new bouns();
            $bouns->emp_major_id = $request->emp_m_id;
            $bouns->bonus_date = date("Y-m-d H:i", strtotime($request->bdate));
            $bouns->bonus_amount = $request->amount;
            $bouns->user_id = Auth::user()->id;
            $bouns->save();
            return redirect('/bouns')->with("message",trans('app.add_sucessfully'));
      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function show($id)
      {
          $bouns = bouns::find($id);
          return view('bouns.show',compact('bouns'));
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function edit($id)
      {
            $bouns = bouns::find($id);
            $employee_major = emplyee_major::all();
            return view('bouns.update',compact('bouns','employee_major'));
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function update(BounsEditRequest $request, $id)
      {
           $bouns = bouns::find($id);
           $bouns->bonus_amount = $request->amount;
           $bouns->save();
           return redirect('/bouns')->with("message",trans('app.update_sucessfully'));
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
           $bouns = bouns::find($id);
           $bouns->delete();
           Session::put('message', trans('app.delete_sucessfully'));
           return json_encode(array("sucess"=>true));
      }

      public function search(Request $request)
      {
           $search_title =  $request->emp_m_id;
           $employee_major = emplyee_major::all();
           $bouns = bouns::where('emp_major_id','=',$search_title)->orderBy("id","desc")->paginate($this->pagination_num);
           return view('bouns.index',compact('bouns','employee_major'));

      }
}
