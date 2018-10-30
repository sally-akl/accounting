<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\extra_salary;
use App\emplyee_major;
use App\employee;
use App\extra_mis_salaries;
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

    protected $pagination_num = 5;
    protected $employee_major;
    protected $salaries_settings;
    public function __construct()
    {
      $this->middleware(function ($request, $next) {

            $query = emplyee_major::whereRaw('1 = 1');
            $query = Common::user_filter_by_role($query,false,array(),"");
            $this->employee_major = $query->get();
            $this->salaries_settings = extra_mis_salaries::where("mtype","extra_salary")->get();
            return $next($request);
       });


    }
    public function index($emp_id)
    {
          $emp_id = intval($emp_id);
          $query = "";
          $query = extra_salary::select("extra_salary.*")->whereRaw('1 = 1')->where("emp_major_id",$emp_id);
          $query = Common::user_filter_by_role($query,true,array("emplyee_majors as c","c.id","emp_major_id"),"extra_salary");
          $extra_salary = $query->orderBy("extra_salary.id","desc")->paginate($this->pagination_num) ;
         return view('extra_salary.index',array("extra_salary"=>$extra_salary , "employee_major"=>$this->employee_major,'emp_id'=>$emp_id,"salary_settings"=>$this->salaries_settings));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($emp_id,Request $request)
    {
        $lay = 'extra_salary.add';
        if($request->ajax())
          $lay = 'ajax.add_extra_salary';
        return view($lay ,array("emp_id"=>$emp_id,"employee_major"=>$this->employee_major,"salary_settings"=>$this->salaries_settings));
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
          $extra_salary->extra_minus_id = $request->sal_min_extra;
          $extra_salary->user_id = Auth::user()->id;
          $extra_salary->save();
          if($request->ajax())
          {
              echo json_encode(array("sucess"=>true));
              exit();
          }
          return redirect('/extrasalary'."/".$request->emp_m_id."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
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
          return view('extra_salary.update',array("employee_major"=>$this->employee_major,"extra_salary"=>$extra_salary,"salary_settings"=>$this->salaries_settings));
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
        // $extra_salary->extra_amount = $request->amount;
        // $extra_salary->title = $request->title;
         $extra_salary->extra_minus_id = $request->sal_min_extra;
         $extra_salary->save();
         return redirect('/extrasalary'."/".$request->m_emp."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
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
         $search_title =  clean($request->sal_min);
         $emp_id =  clean($request->emp_m_id);

         $query = extra_salary::where('extra_minus_id','=',$search_title)->where("emp_major_id",$emp_id);
         $query = Common::user_filter_by_role($query,true,array("emplyee_majors as c","c.id","emp_major_id"),"extra_salary");
         $extra_salary = $query->orderBy("extra_salary.id","desc")->paginate($this->pagination_num);
         return view('extra_salary.index',array("extra_salary"=>$extra_salary , "employee_major"=>$this->employee_major,'emp_id'=>$emp_id,"salary_settings"=>$this->salaries_settings));
    }


}
