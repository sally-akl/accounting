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
      protected $pagination_num = 5;
      protected $employees;
      protected $majors;
      public function __construct()
      {
        $this->middleware(function ($request, $next) {

              $query2 = employee::whereRaw('1 = 1');
              $query2 = Common::user_filter_by_role($query2,false,array(),"");
              $this->categories = $query2->get();
              $this->employees = $query2->get();

              $query2 = major::select("major.*")->whereRaw('1 = 1');
              $query2 = Common::user_filter_by_role($query2,true,array("categories as c","c.id","category_id"),"major");
              $this->majors = $query2->get();
              return $next($request);
         });


      }
      public function index($emp_id)
      {
          $query = "";
          $query = emplyee_major::whereRaw('1 = 1')->where("emplyee_id",$emp_id);
          $query = Common::user_filter_by_role($query,false,array(),"");
          $employee_major = $query->orderBy("id","desc")->paginate($this->pagination_num) ;
          $where_from = 0;
          return view('salaries.index',array("branches"=>Auth::user()->active_branch,"employee_major"=>$employee_major , "majors"=>$this->majors , "employees"=>$this->employees,"emp_id"=>$emp_id,"where_from"=>$where_from));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create($where_from,$emp_id,Request $request)
      {
          $lay = 'salaries.add';
          if($request->ajax())
             $lay = 'ajax.add_salary';
          return view($lay,array("branches"=>Auth::user()->active_branch,"employees"=>$this->employees, "majors"=>$this->majors , "where_from"=>$where_from,"emp_id"=>$emp_id));
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
           $employee_major->branch_id = $request->branch_name;
           $employee_major->currancy = $request->currency;
           $employee_major->user_id = Auth::user()->id;
           $employee_major->save();
           $where_from = $request->where_from;

           if($request->ajax())
           {
               echo json_encode(array("sucess"=>true));
               exit();
           }

           if($where_from != "0")
              return redirect('/'.$where_from.'/create'."/".app()->getLocale()."?branch=".$request->query('branch'));

           return redirect('/employeemajor'."/".$request->employee_val."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
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
      public function edit($id,$emp_id)
      {
          $employee_major = emplyee_major::find($id);
          return view('salaries.update',array("branches"=>Auth::user()->active_branch,"employees"=>$this->employees, "majors"=>$this->majors , "employee_major"=>$employee_major,"emp_id"=>$emp_id));
      }

      public function editcode($id,$emp_id)
      {
          $employee_major = emplyee_major::find($id);
          return view('salaries.updatecode',array('employee_major'=>$employee_major,"emp_id"=>$emp_id));
      }

      public function updatecode(employeeMajorCodeRequest $request,$id)
      {
           $employee_major = emplyee_major::find($id);
           $employee_major->employee_code = $request->employee_code;
           $employee_major->save();
           return redirect('/employeemajor'."/".$request->employee_val."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
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
          $employee_major->branch_id = $request->branch_name;
          $employee_major->currancy = $request->currency;
          $employee_major->save();
          return redirect('/employeemajor'."/".$request->employee_val."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
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
           $emp_id = clean($request->employee_val);
           $query = emplyee_major::where('emplyee_id', '=' , $emp_id);
           $query = Common::user_filter_by_role($query,false,array(),"");
           $employee_major = $query->orderBy("id","desc")->paginate($this->pagination_num);
           return view('salaries.index',array("branches"=>Auth::user()->active_branch,"employee_major"=>$employee_major , "employees"=>$this->employees));
      }

}
