<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\ServiceCodeRequest;
use Session;
use App\classes\Common;
use Auth;
use App\category;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    protected $categories;
    protected $services;
    public function __construct()
    {
          $this->middleware(function ($request, $next) {

              $query2 = category::whereRaw('1 = 1');
              $query2 = Common::user_filter_by_role($query2,false,array(),"");
              $this->categories = $query2->get();
              $query2 = service::select("services.*")->whereRaw('1 = 1');
              $query2 = Common::user_filter_by_role($query2,true,array("categories as c","c.id","category_id"),"services");
              $this->services = $query2->get();
              return $next($request);
         });


    }
    public function index()
    {

        $query = "";
        $query = service::select("services.*")->whereRaw('1 = 1');
        $query = Common::user_filter_by_role($query,true,array("categories as c","c.id","category_id"),"services");
        $services = $query->orderBy("services.id","desc")->paginate($this->pagination_num) ;
        $pservices = $query->get();
        $action = "service";
        return view('service.index',array("pcategories"=>$this->categories,"services"=>$services,"pservices"=>$pservices,"action"=>$action));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('service.add',array("pcategories"=>$this->categories,"services"=>$this->services));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
         $code = Common::GenerateCode(10,'service','service_code');
         $service = new service();
         $service->title = $request->stitle;
         $service->service_code = $code;
         $service->parent_id = $request->parent;
         $service->category_id = $request->category;
         $service->user_id = Auth::user()->id;
         $service->save();
         if($request->action == "category")
            return redirect('/category'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));

         return redirect('/service'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = service::find($id);
        return view('service.show',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $service = service::find($id);
          return view('service.update',array("pcategories"=>$this->categories,"service"=>$service,"services"=>$this->services));
    }

    public function editcode($id)
    {
        $service = service::find($id);
        return view('service.updatecode',compact('service'));
    }

    public function updatecode(ServiceCodeRequest $request,$id)
    {
         $service = service::find($id);
         $service->service_code = $request->service_code;
         $service->save();
         return redirect('/service'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request,$id)
    {
        $service = service::find($id);
        $service->title = $request->stitle;
        $service->parent_id = $request->parent;
        $service->category_id = $request->category;
        $service->save();
        return redirect('/service'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = service::find($id);
        $service->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {
         $search_title =  clean($request->title);
         $query  = service::select("services.*")->where('services.title', 'like', '%' . $search_title . '%');
         $query = Common::user_filter_by_role($query,true,array("categories as c","c.id","category_id"),"services");
         $pservices = $query->get();
         $services =  $query->orderBy("services.id","desc")->paginate($this->pagination_num);
         $action = "service";
         return view('service.index',array("pcategories"=>$this->categories,"services"=>$services,"pservices"=>$pservices,"action"=>$action));
    }
}
