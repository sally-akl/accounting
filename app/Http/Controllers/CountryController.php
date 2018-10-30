<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\country;
use App\Http\Requests\CountryRequest;
use Session;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pagination_num = 5;
    public function index()
    {
         $countries = country::orderBy("id","desc")->paginate($this->pagination_num);
         $countries_all = country::all();
         $where_from = 0;
         $redirect_to_country = 1;
         return view('country.index',compact('countries','where_from','countries_all','redirect_to_country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        return view('country.add',compact('where_from'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
          Session::put('s_action_after', 'country');
          $country = new country();
          $country->title = $request->ctitle;
          $country->save();
          $where_from = $request->where_from;
          return redirect('/country'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));

        //  return redirect('/country'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
        //  return redirect()->back()->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = country::find($id);
        return view('country.show',compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $country = country::find($id);
          return view('country.update',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
         Session::put('s_action_after', 'country');
         $country = country::find($id);
         $country->title = $request->ctitle;
         $country->save();
         return redirect('/country'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $country = country::find($id);
         $country->delete();
         Session::put('message', trans('app.delete_sucessfully'));
         return json_encode(array("sucess"=>true));
    }

    public function search(Request $request)
    {
         $search_title =  clean($request->title);
         $where_from = 0;
         $countries_all = country::all();
         $countries = country::where('title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         $redirect_to_country = 1;
         return view('country.index',compact('countries','where_from','countries_all','redirect_to_country'));

    }


}
