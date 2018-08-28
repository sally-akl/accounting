<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\major;
use App\category;
use App\Http\Requests\MajorRequest;
use Session;
use Auth;
use App\classes\Common;
class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    public function index()
    {
        $majors =  Common::CommonList('major',$this->pagination_num) ;
        return view('major.index',compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        $categories = category::all();
        return view('major.add',compact('categories','where_from'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajorRequest $request)
    {
         $major = new major();
         $major->title =  $request->title;
         $major->category_id =  $request->category;
         $major->user_id = Auth::user()->id;
         $major->save();
         $where_from =  $request->where_from;
         if($where_from != "0")
            return redirect('/'.$where_from.'/create/0');

         return redirect('/major')->with("message",trans('app.add_sucessfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $major = major::find($id);
        return view('major.show',compact('major'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $major = major::find($id);
        $categories = category::all();
        return view('major.update',compact('major','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MajorRequest $request, $id)
    {
         $major = major::find($id);
         $major->title =  $request->title;
         $major->category_id =  $request->category;
         $major->save();
         return redirect('/major')->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $major = major::find($id);
        $major->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {
         $search_title =  $request->title;
         $majors = major::where('title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         return view('major.index',compact('majors'));
    }
}
