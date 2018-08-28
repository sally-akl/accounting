<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tax;
use App\Http\Requests\TaxRequest;
use Session;
class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pagination_num = 10;
    public function index()
    {
        $taxes = tax::orderBy("id","desc")->paginate($this->pagination_num);
        return view('tax.index',compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tax.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRequest $request)
    {
         $tax = new tax();
         $tax->title = $request->title;
         $tax->tax_rate = $request->rate;
         $tax->rate_type = $request->rate_type;
         $tax->save();
         return redirect('/tax')->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tax = tax::find($id);
        return view('tax.show',compact('tax'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = tax::find($id);
        return view('tax.update',compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaxRequest $request, $id)
    {
          $tax = tax::find($id);
          $tax->title = $request->title;
          $tax->tax_rate = $request->rate;
          $tax->rate_type = $request->rate_type;
          $tax->save();
          return redirect('/tax')->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = tax::find($id);
        $tax->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
}
