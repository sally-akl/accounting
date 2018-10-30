<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\city;
use App\country;
use App\branch;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\BranchCodeRequest;
use Session;
use App\classes\Common;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    public function index()
    {
        $branches = branch::orderBy("id","desc")->paginate($this->pagination_num);
        $cities = city::all();
        $countries_all = country::all();
        $redirect_to_country = 2;
        return view('branch.index',compact('branches','cities','redirect_to_country','countries_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::all();
        $cities = city::all();
        return view('branch.add',compact('countries','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
         $code = Common::GenerateCode(10,'branch','branch_code');
         $branch = new branch();
         $branch->branch_code = $code;
         $branch->branch_title = $request->btitle;
         $branch->address = $request->address;
         $branch->phone = $request->phone;
         $branch->city_id = $request->city;
         $branch->email = $request->email;
         $branch->save();
         return redirect('/branch'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $branch = branch::find($id);
         return view('branch.show',compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = branch::find($id);
        $countries = country::all();
        $cities = city::all();
        return view('branch.update',compact('countries','branch','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,BranchRequest $request)
    {
        $branch = branch::find($id);
        $branch->branch_title = $request->btitle;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->city_id = $request->city;
        $branch->email = $request->email;
        $branch->save();
        return redirect('/branch'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    public function editcode($id)
    {
        $branch = branch::find($id);
        return view('branch.updatecode',compact('branch'));
    }

    public function updatecode(BranchCodeRequest $request,$id)
    {
         $branch = branch::find($id);
         $branch->branch_code = $request->code;
         $branch->save();
         return redirect('/branch'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = branch::find($id);
        $branch->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {
         $search_title =  clean($request->title);
         $branches = branch::where('branch_title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         $cities = city::all();
         $countries_all = country::all();
         $redirect_to_country = 2;
         return view('branch.index',compact('branches','cities','redirect_to_country','countries_all'));

    }
}
