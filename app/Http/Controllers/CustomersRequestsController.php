<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer_requests_complain;
use App\Http\Requests\customerrequests;
use App\classes\Common;
use Session;
use Auth;
class CustomersRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pagination_num = 5;
    public function index($id)
    {
         $query = customer_requests_complain::select("customer_requests_complain.*")->where("customer_id",$id)->where("c_type","request");
         $query = Common::user_filter_by_role($query,true,array("customers as c","c.id","customer_id"),"customer_requests_complain");
         $customer_requests = $query->orderBy("customer_requests_complain.id","desc")->paginate($this->pagination_num);
         return view('customer_requests.index',compact('customer_requests','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,Request $request)
    {
        $lay = 'customer_requests.add';
        if($request->ajax())
          $lay = 'ajax.add_customer_requests_compains';

        return view($lay,compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(customerrequests $request)
    {
          $customer_requests_complain = new customer_requests_complain();
          $customer_requests_complain->subject = $request->subject;
          $customer_requests_complain->message = $request->message;
          $customer_requests_complain->customer_id = $request->customer_val;
          $customer_requests_complain->c_type = $request->type_val;
          $customer_requests_complain->m_date = date("Y-m-d H:i", strtotime($request->r_date));
          $customer_requests_complain->user_id = Auth::user()->id;
          $customer_requests_complain->save();
          if($request->ajax())
          {
              echo json_encode(array("sucess"=>true));
              exit();
          }
          return redirect('/customerrequests'."/".$request->customer_val."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$c)
    {
          $customer_requests_complain = customer_requests_complain::find($id);
          return view('customer_requests.update',compact('customer_requests_complain','c'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(customerrequests $request, $id)
    {
         $customer_requests_complain = customer_requests_complain::find($id);
         $customer_requests_complain->subject = $request->subject;
         $customer_requests_complain->message = $request->message;
         $customer_requests_complain->user_id = Auth::user()->id;
         $customer_requests_complain->save();
         return redirect('/customerrequests'."/".$request->customer_val."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $customer_requests_complain = customer_requests_complain::find($id);
         $customer_requests_complain->delete();
         Session::put('message', trans('app.delete_sucessfully'));
         return json_encode(array("sucess"=>true));
    }

    public function search(Request $request)
    {

         $search_title =  clean($request->subjectt);
         $date = clean($request->rr_date);
         $customer_val = clean($request->customer_val);

         $query = customer_requests_complain::select("customer_requests_complain.*")->where("customer_id",$customer_val)->where("c_type","request");
         $query = Common::user_filter_by_role($query,true,array("customers as c","c.id","customer_id"),"customer_requests_complain");
         if(!empty($search_title))
            $query = $query->where('subject', 'like', '%' . $search_title . '%');
         if(!empty($date))
            $query = $query->whereRaw('DATE(m_date)="'.$date.'"');


         $customer_requests = $query->orderBy("customer_requests_complain.id","desc")->paginate($this->pagination_num);
         return view('customer_requests.index',array("customer_requests"=>$customer_requests , "id"=>$customer_val));
    }


}
