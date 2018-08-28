<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\account;
use App\Http\Requests\AccountRequest;
use App\classes\Common;
use Session;
use Auth;
class accountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pagination_num = 10;
    public function index()
    {
         $accounts =  Common::CommonList('account',$this->pagination_num ) ;
         return view('account.index',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        return view('account.add',compact('where_from'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
          $account = new account();
          $account->bank_name = $request->bankname;
          $account->account_number = $request->number;
          $account->branch_location = $request->location;
          $account->branch_city = $request->city;
          $account->open_balance = $request->balance;
          $account->user_id = Auth::user()->id;
          $account->save();
          $where_from =  $request->where_from;
          if($where_from != "0")
             return redirect('/transactions/create/'.$where_from);
          return redirect('/account')->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $account = account::find($id);
          return view('account.show',compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = account::find($id);
        return view('account.update',compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request,$id)
    {
          $account = account::find($id);
          $account->bank_name = $request->bankname;
          $account->account_number = $request->number;
          $account->branch_location = $request->location;
          $account->branch_city = $request->city;
          $account->open_balance = $request->balance;
          $account->save();
          return redirect('/account')->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $account = account::find($id);
          $account->delete();
          Session::put('message', trans('app.delete_sucessfully'));
          return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {
         $bankname =  $request->bankname;
         $account_num =  $request->number;
         $from = $request->from;
         $to = $request->to;

         $accounts = account::where('bank_name', 'like', '%' . $bankname . '%')->
                   where('account_number', 'like', '%' . $account_num . '%')
                   ->orderBy("id","desc")->paginate($this->pagination_num);

         if(!empty($from) && !empty($to))
         {
             $accounts = account::where('bank_name', 'like', '%' . $bankname . '%')->
                     where('account_number', 'like', '%' . $account_num . '%')
                     ->where(function($query) use ($from,$to){
                         $query->whereBetween('open_balance',array($from,$to));
                    })
                     ->orderBy("id","desc")->paginate($this->pagination_num);

         }



         return view('account.index',compact('accounts'));

    }


}
