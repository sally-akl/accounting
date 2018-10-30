<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\customer;
use App\contracts;
use App\Http\Requests\ContractRequest;
use Session;
use App\classes\Common;
use Auth;
class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    protected $employees;
    protected $customers;
    public function __construct()
    {
      $this->middleware(function ($request, $next) {

            $query = employee::whereRaw('1 = 1');
            $query = Common::user_filter_by_role($query,false,array(),"");
            $this->employees = $query->orderBy("id","desc")->get();

            $query = customer::whereRaw('1 = 1');
            $query = Common::user_filter_by_role($query,false,array(),"");
            $this->customers = $query->orderBy("id","desc")->get();

            return $next($request);
       });


    }
    public function index()
    {
        $query = "";
        $query = contracts::whereRaw('1 = 1');
        $query = Common::user_filter_by_role($query,false,array(),"");
        $contracts = $query->orderBy("id","desc")->paginate($this->pagination_num) ;
        return view('contracts.index',array("contracts"=>$contracts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contracts.add',array("branches"=>Auth::user()->active_branch,"employees"=>$this->employees,"customers"=>$this->customers));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
          $contract = new contracts();
          $contract->begin_date = date("Y-m-d H:i", strtotime($request->b_date));
          $contract->end_date =  date("Y-m-d H:i", strtotime($request->e_date));
          $contract->content =  $request->cont;
          $contract->title =  $request->ti;
          $contract->for_type =  $request->ft;
          if($request->ft == "customers")
            $contract->for_type_id =  $request->cut;
          if($request->ft == "employees")
              $contract->for_type_id =  $request->emp;

          if($request->signature_type == "by_signature")
          {
              $contract->contract_signiture =  $request->sign_one;
              $contract->contract_signature_two =  $request->sign_two;

          }
          else if($request->signature_type == "digital_sign")
          {
              if($request->logo != null)
              {
                $imageName = time().'.'.$request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('images'), $imageName);
                $contract->digital_sign =  $imageName;
              }
          }

          $contract->branch_id = $request->branch_name;
          $contract->user_id = Auth::user()->id;
          $contract->save();
          return redirect('/contracts'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = contracts::find($id);
        $contract->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));

    }
    public function search(Request $request)
    {
         $from = "";
         $to = "";
         $query = contracts::whereRaw('1 = 1');
         $query = Common::user_filter_by_role($query,false,array(),"");

         $request->transfer_from = clean($request->transfer_from);
         $request->transfer_to =  clean($request->transfer_to);
         if(!empty($request->transfer_from))
           $from = date("Y-m-d H:i", strtotime($request->transfer_from));
         if(!empty($request->transfer_to))
           $to = date("Y-m-d H:i", strtotime($request->transfer_to));

         if(!empty($from) && !empty($to))
         {
              $query = $query->where(function($query2) use ($from,$to){
                             $query2->whereBetween('begin_date',array($from,$to));
              });
         }

         $contracts = $query->orderBy("id","desc")->paginate($this->pagination_num) ;
         return view('contracts.index',array("contracts"=>$contracts));
    }




}
