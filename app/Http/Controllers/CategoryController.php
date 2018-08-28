<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
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
    protected $pagination_num = 10;
    public function index()
    {

        $categories = Common::CommonList('category',$this->pagination_num ) ;
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        $categories = category::all();
        return view('category.add',compact('categories','where_from'));
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
         $category->user_id = Auth::user()->id;
         $category->save();
         $where_from = $request->where_from;
         if($where_from != "0")
            return redirect('/'.$where_from.'/create/0');

         return redirect('/category')->with("message",trans('app.add_sucessfully'));
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
        return view('category.update',compact('category','categories'));
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
         return redirect('/category')->with("message",trans('app.update_sucessfully'));
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
        $category->save();
        return redirect('/category')->with("message",trans('app.update_sucessfully'));
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
         $search_title =  $request->title;
         $categories = category::where('title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         return view('category.index',compact('categories'));
    }


}
