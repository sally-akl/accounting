<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\job;
use App\Http\Requests\EmployeeRequest;
use Session;
use App\classes\Common;
use Auth;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    protected $status = array("1"=>"Active","2"=>"Not active");
    protected $jobs;
    public function __construct()
    {
      $this->middleware(function ($request, $next) {

           $query = job::select("jobs.*")->whereRaw('1 = 1');
           $query = Common::user_filter_by_role($query,true,array("categories as c","c.id","category_id"),"jobs");
           $this->jobs = $query->get() ;
            return $next($request);
       });


    }

    public function index()
    {
        $query = "";
        $query = employee::whereRaw('1 = 1');
        $query = Common::user_filter_by_role($query,false,array(),"");
        $employees = $query->orderBy("id","desc")->paginate($this->pagination_num) ;
        return view('employee.index',array("branches"=>Auth::user()->active_branch,"employees"=>$employees,"status"=>$this->status));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {

        return view('employee.add',array("branches"=>Auth::user()->active_branch,"where_from"=>$where_from,"jobs"=>$this->jobs));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
         $employee = new employee();
         $employee->employee_name = $request->name;
         $employee->employee_address = $request->address;
         $employee->employee_email = $request->employee_email;
         $employee->employee_phone = $request->phone;
         $employee->employee_status = $request->status;
         $employee->employee_details = $request->details;
         $employee->branch_id = $request->branch_name;
         $employee->job_id = $request->job_title;
         $employee->employee_join_date = date("Y-m-d H:i", strtotime($request->join_date));
         $employee->user_id = Auth::user()->id;
         $employee->save();
         $where_from =  $request->where_from;
         if($where_from != "0")
         {
             if($where_from == "employeemajor")
                 return redirect('/'.$where_from.'/create/0/0'."/".app()->getLocale()."?branch=".$request->query('branch'));
              return redirect('/'.$where_from.'/create/0'."/".app()->getLocale()."?branch=".$request->query('branch'));
         }


         return redirect('/employee'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $employee = employee::find($id);
          return view('employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = employee::find($id);
        return view('employee.update',array("branches"=>Auth::user()->active_branch,"employee"=>$employee,"jobs"=>$this->jobs));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
          $employee = employee::find($id);
          $employee->employee_name = $request->name;
          $employee->employee_address = $request->address;
          $employee->employee_email = $request->employee_email;
          $employee->employee_phone = $request->phone;
          $employee->employee_status = $request->status;
          $employee->employee_details = $request->details;
          $employee->branch_id = $request->branch_name;
          $employee->job_id = $request->job_title;
          $employee->employee_join_date = date("Y-m-d H:i", strtotime($request->join_date));
          $employee->save();
          return redirect('/employee'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $employee = employee::find($id);
          $employee->delete();
          Session::put('message', trans('app.delete_sucessfully'));
          return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {
         $status = array("1"=>"Active","2"=>"Not active");
         $name  =  clean($request->name);
         $email =  clean($request->email);
         $join_date = clean($request->join_date);


         $query = employee::whereRaw('1 = 1');
         if(!empty($name))
           $query = $query->where('employee_name', 'like', '%' . $name . '%');
         if(!empty($email))
           $query = $query-> where('employee_email', 'like', '%' . $email . '%');
         if(!empty($join_date))
           $query = $query-> where('employee_join_date', date('Y-m-d H:i',strtotime($join_date)));

         $query = Common::user_filter_by_role($query,false,array(),"");
         $employees =  $query->orderBy("id","desc")->paginate($this->pagination_num);
         return view('employee.index',array("branches"=>Auth::user()->active_branch,"employees"=>$employees,"status"=>$this->status));

    }



}
