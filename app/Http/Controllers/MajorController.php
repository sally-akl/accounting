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
    protected $pagination_num = 5;
    protected $categories;
    public function __construct()
    {
      $this->middleware(function ($request, $next) {

            $query2 = category::whereRaw('1 = 1');
            $query2 = Common::user_filter_by_role($query2,false,array(),"");
            $this->categories = $query2->get();
            return $next($request);
       });


    }
    public function index()
    {

        $query = "";
        $query = major::select("major.*")->whereRaw('1 = 1');
        $query = Common::user_filter_by_role($query,true,array("categories as c","c.id","category_id"),"major");
        $majors = $query->orderBy("major.id","desc")->paginate($this->pagination_num) ;
        return view('major.index',compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        $lay = 'major.add';
        if($where_from == 1)
         $lay = "ajax.add_major";
        return view($lay,array("categories"=>$this->categories,"where_from"=>$where_from,"show_link"=>true,"is_ajax"=>$where_from));
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
         if($request->is_ajax == 1)
         {
            echo json_encode(array("sucess"=>true));
            exit();
         }


         if($where_from != "0" && !is_numeric($where_from) )
            return redirect('/'.$where_from.'/create/0'."/".app()->getLocale()."?branch=".$request->query('branch'));
        else if($where_from != 0 && is_numeric($where_from))
            return redirect('/employeemajor'."/".$where_from.'/'.app()->getLocale()."?branch=".$request->query('branch'));

         return redirect('/major'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));

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
        return view('major.update',array("categories"=>$this->categories,"major"=>$major));
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
         return redirect('/major'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
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
         $search_title =  clean($request->title);
         $query =  major::select("major.*")->where('major.title', 'like', '%' . $search_title . '%');
         $query = Common::user_filter_by_role($query,true,array("categories as c","c.id","category_id"),"major");
         $majors = $query->orderBy("id","desc")->paginate($this->pagination_num);
         return view('major.index',compact('majors'));
    }
}
