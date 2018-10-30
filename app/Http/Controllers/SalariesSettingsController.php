<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\extra_mis_salaries;
use App\Http\Requests\ExtraMinSalariesRequest;
use Session;
use App\classes\Common;
use Auth;
class SalariesSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    public function index($mtype)
    {
        $extra_min_salarries = extra_mis_salaries::where("mtype",$mtype)->orderBy("id","desc")->paginate($this->pagination_num) ;
        return view('salary_settings.index',array("extra_min_salarries"=>$extra_min_salarries,"mtype"=>$mtype));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mtype)
    {
        return view('salary_settings.add',compact('mtype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExtraMinSalariesRequest $request)
    {
         $salary_settings = new extra_mis_salaries();
         $salary_settings->title = $request->mtitle;
         $salary_settings->percentage = $request->percent;
         $salary_settings->user_id = Auth::user()->id;
         $salary_settings->mtype = $request->ty;
         $salary_settings->val_type = $request->vtype;
         $salary_settings->save();
         return redirect('/salarysettings'."/".$request->ty."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$mtype)
    {
        $salary_settings = extra_mis_salaries::find($id);
        return view('salary_settings.update',array("salary_settings"=>$salary_settings,"mtype"=>$mtype));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExtraMinSalariesRequest $request, $id)
    {
        $salary_settings = extra_mis_salaries::find($id);
        $salary_settings->title = $request->mtitle;
        $salary_settings->percentage = $request->percent;
        $salary_settings->mtype = $request->ty;
        $salary_settings->val_type = $request->vtype;
        $salary_settings->save();
        return redirect('/salarysettings'."/".$request->ty."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary_settings = extra_mis_salaries::find($id);
        $salary_settings->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }

    public function search(Request $request)
    {
         $search_title =  clean($request->title);
         $mtype = clean($request->mtype);
         $extra_min_salarries = extra_mis_salaries::where("mtype",$mtype)->where('title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         return view('salary_settings.index',array("extra_min_salarries"=>$extra_min_salarries,"mtype"=>$mtype));
    }


}
