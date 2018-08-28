<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
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
    protected $pagination_num = 10;
    public function index()
    {
         $employees = Common::CommonList('employee',$this->pagination_num ) ;
         $status = array("1"=>"Active","2"=>"Not active");
         return view('employee.index',compact('employees','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        return view('employee.add',compact('where_from'));
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
         $employee->employee_join_date = date("Y-m-d H:i", strtotime($request->join_date));
         $employee->user_id = Auth::user()->id;
         $employee->save();
         $where_from =  $request->where_from;
         if($where_from != "0")
            return redirect('/'.$where_from.'/create/0');

         return redirect('/employee')->with("message",trans('app.add_sucessfully'));
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
        return view('employee.update',compact('employee'));
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
          $employee->employee_join_date = date("Y-m-d H:i", strtotime($request->join_date));
          $employee->save();
          return redirect('/employee')->with("message",trans('app.update_sucessfully'));
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
         $name  =  $request->name;
         $email =  $request->email;
         $join_date = $request->join_date;

         $employees = employee::where('employee_name', 'like', '%' . $name . '%')->
                   where('employee_email', 'like', '%' . $email . '%')
                   ->orderBy("id","desc")->paginate($this->pagination_num);

         if(!empty($join_date))
         {
               $employees = employee::where('employee_name', 'like', '%' . $name . '%')->
                     where('employee_email', 'like', '%' . $email . '%')->
                     where('employee_join_date', date('Y-m-d H:i',strtotime($join_date)))
                     ->orderBy("id","desc")->paginate($this->pagination_num);

         }


         return view('employee.index',compact('employees','status'));

    }



}
