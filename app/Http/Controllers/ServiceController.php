<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\ServiceCodeRequest;
use Session;
use App\classes\Common;
use Auth;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    public function index()
    {
        $services = Common::CommonList('service',$this->pagination_num ) ;
        return view('service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $services = service::all();
          return view('service.add',compact('services'));
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
         $service->title = $request->title;
         $service->service_code = $code;
         $service->parent_id = $request->parent;
         $service->user_id = Auth::user()->id;
         $service->save();
         return redirect('/service')->with("message",trans('app.add_sucessfully'));

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
          $services = service::all();
          return view('service.update',compact('service','services'));
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
         return redirect('/service')->with("message",trans('app.update_sucessfully'));
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
        $service->title = $request->title;
        $service->parent_id = $request->parent;
        $service->save();
        return redirect('/service')->with("message",trans('app.update_sucessfully'));
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
         $search_title =  $request->title;
         $services = service::where('title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         return view('service.index',compact('services'));
    }
}
