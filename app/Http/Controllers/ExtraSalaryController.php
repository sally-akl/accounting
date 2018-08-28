<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\extra_salary;
use App\emplyee_major;
use App\employee;
use App\Http\Requests\ExtraSalaryRequest;
use App\Http\Requests\ExtraSalaryEditRequest;
use App\classes\Common;
use Session;
use Auth;
class ExtraSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pagination_num = 10;
    public function index()
    {
         $extra_salary = Common::CommonList('extra_salary',$this->pagination_num ) ;
         $employee_major = emplyee_major::all();
         return view('extra_salary.index',compact('extra_salary','employee_major'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee_major = emplyee_major::all();
        return view('extra_salary.add',compact('employee_major'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExtraSalaryRequest $request)
    {
          $extra_salary = new extra_salary();
          $extra_salary->emp_major_id = $request->emp_m_id;
          $extra_salary->title = $request->title;
          $extra_salary->extra_amount = $request->amount;
          $extra_salary->user_id = Auth::user()->id;
          $extra_salary->save();
          return redirect('/extrasalary')->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $extra_salary = extra_salary::find($id);
        return view('extra_salary.show',compact('extra_salary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $extra_salary = extra_salary::find($id);
          $employee_major = emplyee_major::all();
          return view('extra_salary.update',compact('extra_salary','employee_major'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExtraSalaryEditRequest $request, $id)
    {
         $extra_salary = extra_salary::find($id);
         $extra_salary->extra_amount = $request->amount;
         $extra_salary->title = $request->title;
         $extra_salary->save();
         return redirect('/extrasalary')->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $extra_salary = extra_salary::find($id);
         $extra_salary->delete();
         Session::put('message', trans('app.delete_sucessfully'));
         return json_encode(array("sucess"=>true));
    }

    public function search(Request $request)
    {
         $search_title =  $request->emp_m_id;
         $employee_major = emplyee_major::all();
         $extra_salary = extra_salary::where('emp_major_id','=',$search_title)->orderBy("id","desc")->paginate($this->pagination_num);
         return view('extra_salary.index',compact('extra_salary','employee_major'));

    }


}
