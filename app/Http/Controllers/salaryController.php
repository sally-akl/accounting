<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\emplyee_major;
use App\employee;
use App\major;
use App\Http\Requests\employeeMajorRequest;
use App\Http\Requests\employeeMajorEditRequest;
use App\Http\Requests\employeeMajorCodeRequest;
use Session;
use App\classes\Common;
use Auth;
class salaryController extends Controller
{
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      protected $pagination_num = 10;
      public function index()
      {
          $employees = employee::all();
          $employee_major = Common::CommonList('emplyee_major',$this->pagination_num ) ;
          return view('salaries.index',compact('employee_major','employees'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create($where_from)
      {
          $employees = employee::all();
          $majors = major::all();
          return view('salaries.add',compact('employees','majors','where_from'));
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(employeeMajorRequest $request)
      {
           $code = Common::GenerateCode(10,'emplyee_major','employee_code');
           $employee_major = new emplyee_major();
           $employee_major->emplyee_id = $request->employee_val;
           $employee_major->major_id = $request->major_val;
           $employee_major->join_date = date("Y-m-d H:i", strtotime($request->join_date));
           $employee_major->is_current = $request->is_current == "on"?1:0;
           $employee_major->current_salary = $request->salary;
           $employee_major->employee_code = $code;
           $employee_major->user_id = Auth::user()->id;
           $employee_major->save();
           $where_from = $request->where_from;

           if($where_from != "0")
              return redirect('/'.$where_from.'/create');

           return redirect('/employeemajor')->with("message",trans('app.add_sucessfully'));
      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function show($id)
      {
          $employee_major = emplyee_major::find($id);
          return view('salaries.show',compact('employee_major'));
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function edit($id)
      {
          $employee_major = emplyee_major::find($id);
          $employees = employee::all();
          $majors = major::all();
          return view('salaries.update',compact('employee_major','employees','majors'));
      }

      public function editcode($id)
      {
          $employee_major = emplyee_major::find($id);
          return view('salaries.updatecode',compact('employee_major'));
      }

      public function updatecode(employeeMajorCodeRequest $request,$id)
      {
           $employee_major = emplyee_major::find($id);
           $employee_major->employee_code = $request->employee_code;
           $employee_major->save();
           return redirect('/employeemajor')->with("message",trans('app.update_sucessfully'));
      }



      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function update(employeeMajorEditRequest $request, $id)
      {
          $employee_major = emplyee_major::find($id);
          $employee_major->is_current = $request->is_current == "on"?1:0;
          $employee_major->current_salary = $request->salary;
          $employee_major->save();
          return redirect('/employeemajor')->with("message",trans('app.update_sucessfully'));
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
          $employee_major = emplyee_major::find($id);
          $employee_major->delete();
          Session::put('message', trans('app.delete_sucessfully'));
          return json_encode(array("sucess"=>true));
      }

      public function search(Request $request)
      {
           $emp_id =  $request->employee_val;
           $employees = employee::all();
           $employee_major = emplyee_major::where('emplyee_id', '=' , $emp_id)->orderBy("id","desc")->paginate($this->pagination_num);
           return view('salaries.index',compact('employee_major','employees'));
      }

}
