<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expense_type;
use App\Http\Requests\ExpenseTypeRequest;
use Session;
use App\classes\Common;
use Auth;
class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    public function index()
    {
        $expenses = expense_type::orderBy("id","desc")->paginate($this->pagination_num) ;
        return view('expenseType.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        return view('expenseType.add',compact('where_from'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseTypeRequest $request)
    {
         $expense_type = new expense_type();
         $expense_type->title = $request->title;
         $expense_type->user_id = Auth::user()->id;
         $expense_type->save();
         $where_from =  $request->where_from;
         if($where_from != "0")
            return redirect('/transactions/create/'.$where_from."/".app()->getLocale()."?branch=".$request->query('branch'));


         return redirect('/expense'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = expense_type::find($id);
        return view('expenseType.show',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = expense_type::find($id);
        return view('expenseType.update',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseTypeRequest $request,$id)
    {
        $expense = expense_type::find($id);
        $expense->title = $request->title;
        $expense->save();
        return redirect('/expense'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $expense = expense_type::find($id);
         $expense->delete();
         Session::put('message', trans('app.delete_sucessfully'));
         return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {
         $search_title =  clean($request->title);
         $expenses = expense_type::where('title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         return view('expenseType.index',compact('expenses'));
    }

}
