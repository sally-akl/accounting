<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bouns;
use App\emplyee_major;
use App\extra_mis_salaries;
use App\Http\Requests\BounsRequest;
use App\Http\Requests\BounsEditRequest;
use Session;
use App\classes\Common;
use Auth;
class BounsController extends Controller
{
      protected $pagination_num = 5;
      protected $employee_major;
      protected $salaries_settings;
      public function __construct()
      {
        $this->middleware(function ($request, $next) {

              $query = emplyee_major::whereRaw('1 = 1');
              $query = Common::user_filter_by_role($query,false,array(),"");
              $this->employee_major = $query->get();
              $this->salaries_settings = extra_mis_salaries::where("mtype","bouns")->get();
              return $next($request);
         });


      }

      public function index($emp_id)
      {
           $emp_id = intval($emp_id);
           $query = "";
           $query = bouns::select("bonus.*")->whereRaw('1 = 1')->where("emp_major_id",$emp_id);
           $query = Common::user_filter_by_role($query,true,array("emplyee_majors as c","c.id","emp_major_id"),"bonus");
           $bouns = $query->orderBy("bonus.id","desc")->paginate($this->pagination_num) ;
           return view('bouns.index',array("bouns"=>$bouns , "employee_major"=>$this->employee_major,'emp_id'=>$emp_id,"salary_settings"=>$this->salaries_settings));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create($emp_id,Request $request)
      {
          $lay = 'bouns.add';
          if($request->ajax())
            $lay = 'ajax.add_bouns';
          return view(  $lay,array("emp_id"=>$emp_id,"employee_major"=>$this->employee_major,"salary_settings"=>$this->salaries_settings));
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(BounsRequest $request)
      {
            Session::put('s_action_after', 'bouns');
            $bouns = new bouns();
            $bouns->emp_major_id = $request->emp_m_id;
            $bouns->bonus_date = date("Y-m-d H:i", strtotime($request->bdate));
            $bouns->extra_minus_id = $request->sal_min_extra;
            $bouns->user_id = Auth::user()->id;
            $bouns->save();

            if($request->ajax())
            {
                echo json_encode(array("sucess"=>true));
                exit();
            }
            return redirect('/bouns'."/".$request->emp_m_id."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
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
            return view('bouns.update',array("bouns"=>$bouns , "employee_major"=>$this->employee_major,"salary_settings"=>$this->salaries_settings));
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
           Session::put('s_action_after', 'bouns');
           $bouns = bouns::find($id);
           $bouns->extra_minus_id = $request->sal_min_extra;
           $bouns->save();
           return redirect('/bouns'."/".$request->m_emp."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
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
           $search_title = clean( $request->sal_min);
           $emp_id = clean($request->emp_m_id);
           $query = bouns::where('bonus.emp_major_id','=',$search_title)->where("emp_major_id",$emp_id);
           $query = Common::user_filter_by_role($query,true,array("emplyee_majors as c","c.id","emp_major_id"),"bonus");
           $bouns = $query->orderBy("bonus.id","desc")->paginate($this->pagination_num);
           return view('bouns.index',array("bouns"=>$bouns , "employee_major"=>$this->employee_major,'emp_id'=>$emp_id,"salary_settings"=>$this->salaries_settings));
      }
}
