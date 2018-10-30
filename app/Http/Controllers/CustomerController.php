<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\city;
use App\Http\Requests\CustomerRequest;
use Session;
use App\classes\Common;
use Auth;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    public function index()
    {
        $query = "";

        $query = customer::whereRaw('1 = 1');
        $query = Common::user_filter_by_role($query,false,array(),"");
        $customer = $query->orderBy("id","desc")->paginate($this->pagination_num) ;
        return view('customer.index',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lay = 'customer.add';
        if($request->ajax())
          $lay = 'ajax.add_customer';

        $citites = city::all();
        return view($lay,array("branches"=>Auth::user()->active_branch,"citites"=>$citites));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
         $customer = new customer();
         $customer->full_name = $request->fullname;
         $customer->email = $request->email;
         $customer->phone = $request->phone;
         $customer->address = $request->address;
         $customer->city_id = $request->city_val;
         $customer->branch_id = $request->branch_name;
         $customer->user_id = Auth::user()->id;
         $customer->save();

         if($request->ajax())
         {
             echo json_encode(array("sucess"=>true));
             exit();
         }

         return redirect('/customer'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = customer::find($id);
        return view('customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = customer::find($id);
        $citites = city::all();
        return view('customer.update',array("branches"=>Auth::user()->active_branch,"citites"=>$citites,"customer"=>$customer));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request,$id)
    {
        $customer = customer::find($id);
        $customer->full_name = $request->fullname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->city_id = $request->city_val;
        $customer->branch_id = $request->branch_name;
        $customer->save();
        return redirect('/customer'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = customer::find($id);
        $customer->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));

    }

    public function search(Request $request)
    {
         $name  =  clean($request->fullname);
         $email =  clean($request->email);
         $join_date = clean($request->join_date);

          $query = customer::whereRaw('1 = 1');
          if(!empty($name))
            $query = $query->where('full_name', 'like', '%' . $name . '%');
          if(!empty( $email ))
            $query = $query->where('email', 'like', '%' . $email . '%');

            $query = Common::user_filter_by_role($query,false,array(),"");
            $customer = $query->orderBy("id","desc")->paginate($this->pagination_num);
            return view('customer.index',compact('customer'));
    }

    public function get_address($id)
    {
        $customer = customer::find($id);
        if($customer != null)
          return json_encode(array("msg"=>"sucess","address"=>$customer->address));

        return json_encode(array("msg"=>"fail"));

    }
}
