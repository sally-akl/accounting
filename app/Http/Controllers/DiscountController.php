<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\discount;
use App\emplyee_major;
use App\extra_mis_salaries;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\DiscountEditRequest;
use Session;
use App\classes\Common;
use Auth;

class DiscountController extends Controller
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
              $this->salaries_settings = extra_mis_salaries::where("mtype","discount")->get();
              return $next($request);
         });


      }
      public function index($emp_id)
      {
          $emp_id = intval($emp_id);
          $query = "";
          $query = discount::select("discount.*")->whereRaw('1 = 1')->where("emp_major_id",$emp_id);
          $query = Common::user_filter_by_role($query,true,array("emplyee_majors as c","c.id","emp_major_id"),"discount");
          $discount = $query->orderBy("discount.id","desc")->paginate($this->pagination_num) ;
          return view('discount.index',array("discount"=>$discount, "employee_major"=>$this->employee_major,'emp_id'=>$emp_id,"salary_settings"=>$this->salaries_settings));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create($emp_id,Request $request)
      {
          $lay = 'discount.add';
          if($request->ajax())
            $lay = 'ajax.add_discount';
          return view($lay,array("emp_id"=>$emp_id,"employee_major"=>$this->employee_major,"salary_settings"=>$this->salaries_settings));
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
          //  $discount->discount_amount = $request->amount;
            $discount->extra_minus_id = $request->sal_min_extra;
            $discount->user_id = Auth::user()->id;
            $discount->save();
            if($request->ajax())
            {
                echo json_encode(array("sucess"=>true));
                exit();
            }
            return redirect('/discount'."/".$request->emp_m_id."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
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
            return view('discount.update',array("discount"=>$discount, "employee_major"=>$this->employee_major,"salary_settings"=>$this->salaries_settings));
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
           //$discount->discount_amount = $request->amount;
           $discount->extra_minus_id = $request->sal_min_extra;
           $discount->save();
           return redirect('/discount'."/".$request->m_emp."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
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
           $search_title =  clean($request->sal_min);
           $emp_id =  clean($request->emp_m_id);
           $query = discount::where('discount.emp_major_id','=',$search_title)->where("emp_major_id",$emp_id);
           $query = Common::user_filter_by_role($query,true,array("emplyee_majors as c","c.id","emp_major_id"),"discount");
           $discount = $query->orderBy("discount.id","desc")->paginate($this->pagination_num);
           return view('discount.index',array("discount"=>$discount, "employee_major"=>$this->employee_major,'emp_id'=>$emp_id,"salary_settings"=>$this->salaries_settings));
      }
}
