<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\service;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryCodeRequest;
use Session;
use App\classes\Common;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    protected $services;
    protected $pcategories;
    public function __construct()
    {
          $this->middleware(function ($request, $next) {
              $query2 = service::select("services.*")->whereRaw('1 = 1');
              $query2 = Common::user_filter_by_role($query2,true,array("categories as c","c.id","category_id"),"services");
              $this->services = $query2->get();

              $query = category::whereRaw('1 = 1');
              $query = Common::user_filter_by_role($query,false,array(),"");
              $this->pcategories = $query->get();

              return $next($request);
         });


    }

    public function index(Request $request)
    {
        $query = "";
        $query = category::whereRaw('1 = 1');
        $query = Common::user_filter_by_role($query,false,array(),"");
        $categories = $query->orderBy("id","desc")->paginate($this->pagination_num) ;
        $action = "category";
        $show_href = false;
        $where_from = 0;
        return view('category.index',array("branches"=>Auth::user()->active_branch,"categories"=>$categories,"pcategories"=>$this->pcategories,"action"=>$action,"pservices"=>$this->services,"show_href"=>$show_href,"where_from"=>$where_from));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        $lay = 'category.add';
        if($where_from == 1)
          $lay = "ajax.add_category";
        return view($lay,array("branches"=>Auth::user()->active_branch,"pcategories"=>$this->pcategories,"where_from"=>$where_from,"is_ajax"=>$where_from) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
         $code = Common::GenerateCode(10,'category','category_code');
         $category = new category();
         $category->title = $request->title;
         $category->category_code = $code;
         $category->parent_id = $request->parent;
         $category->branch_id = $request->branch_name;
         $category->user_id = Auth::user()->id;
         $category->save();
         $where_from = $request->where_from;
         if($request->is_ajax == 1)
         {
            echo json_encode(array("sucess"=>true));
            exit();
         }


         if($where_from != "0")
            return redirect('/'.$where_from.'/create/0');

         return redirect('/category'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = category::find($id);
        return view('category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category::find($id);
        $categories = category::all();
        return view('category.update',array("branches"=>Auth::user()->active_branch,"category"=>$category,"categories"=>$this->pcategories));
    }

    public function editcode($id)
    {
        $category = category::find($id);
        return view('category.updatecode',compact('category'));
    }

    public function updatecode(CategoryCodeRequest $request,$id)
    {
         $category = category::find($id);
         $category->category_code = $request->category_code;
         $category->save();
         return redirect('/category'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = category::find($id);
        $category->title = $request->title;
        $category->parent_id = $request->parent;
        $category->branch_id = $request->branch_name;
        $category->save();
        return redirect('/category'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = category::find($id);
        $category->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }

    public function search(Request $request)
    {
         $search_title =  clean($request->title);
         $action = "category";
         $show_href = false;
         $where_from = 0;
         $pcategories = category::all();
         $query = category::where('title', 'like', '%' . $search_title . '%');
         if(!Auth::user()->IsAdmin())
         {
            $query = Common::user_filter_by_role($query,false,array(),"");
            $pcategories = $query->get();
         }
         $categories = $query->orderBy("id","desc")->paginate($this->pagination_num);
         return view('category.index',array("branches"=>Auth::user()->active_branch,"categories"=>$categories,"pcategories"=>$this->pcategories,"action"=>$action,"pservices"=>$this->services,"show_href"=>$show_href,"where_from"=>$where_from));
    }


}
