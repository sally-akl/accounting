<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\city;
use App\country;
use App\Http\Requests\CityRequest;
use Session;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 5;
    public function index($c)
    {
        $cities = city::where("country_id",$c)->orderBy("id","desc")->paginate($this->pagination_num);
        $countries = country::all();
        return view('city.index',array("cities"=>$cities,"countries"=>$countries,"c"=>$c));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($c,Request $request)
    {
        $lay = 'city.add';
        if($request->ajax())
          $lay = 'ajax.add_city';

        $countries_all = country::all();
        return view($lay,array("c"=>$c,"countries_all"=>$countries_all));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
         $city = new city();
         $city->title = $request->title;
         $city->country_id = $request->country_value;
         $city->save();

         if($request->ajax())
         {
             echo json_encode(array("sucess"=>true));
             exit();
         }

         $is_redirect = $request->redirect_to_country;
         if($is_redirect == 1)
            return redirect('/country'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
         if($is_redirect == 2)
               return redirect('/branch'."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));

         return redirect('/city'."/".$request->country_value."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $city = city::find($id);
         return view('city.show',compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$c)
    {
        $city = city::find($id);
        $countries = country::all();
        return view('city.update',array("city"=>$city,"countries"=>$countries,"c"=>$c));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request,$id)
    {
        $city = city::find($id);
        $city->title = $request->title;
        $city->country_id = $request->country_value;
        $city->save();
        return redirect("/city"."/".$request->country_value."/".app()->getLocale()."?branch=".$request->query('branch'))->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = city::find($id);
        $city->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {
         $search_title =  clean($request->title);
         $c = clean($request->country);
         $cities = city::where("country_id",$request->country)->where('title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         $countries = country::all();
         return view('city.index',array("cities"=>$cities,"countries"=>$countries,"c"=>$c));

    }
    public function get_city_by_country($id)
    {
        $country = country::find($id);
        $cities = $country->city;
        $html = "";
        foreach($cities as $city)
        {
            $html .="<option value='".$city->id."'>".$city->title."</option>";
        }
        return json_encode(array("cities"=>$html));

    }



}
