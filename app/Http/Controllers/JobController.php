<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\job;
use App\Http\Requests\JobRequest;
use App\Http\Requests\JobCodeRequest;
use Session;
use App\classes\Common;
use App\category;
use Auth;
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    public function index()
    {
        $jobs = Common::CommonList('job',$this->pagination_num ) ;
        return view('job.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($where_from)
    {
        $categories = category::all();
        return view('job.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
          $code = Common::GenerateCode(10,'job','job_code');
          $job = new job();
          $job->title = $request->title;
          $job->category_id = $request->category;
          $job->user_id = Auth::user()->id;
          $job->default_salary = 0;
          $job->job_code = $code;
          $job->save();
          return redirect('/job')->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = job::find($id);
        return view('job.show',compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = job::find($id);
        $categories = category::all();
        return view('job.update',compact('job','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request,$id)
    {
          $job = job::find($id);
          $job->title = $request->title;
          $job->category_id = $request->category;
          $job->default_salary = 0;
          $job->save();
          return redirect('/job')->with("message",trans('app.update_sucessfully'));
    }

    public function editcode($id)
    {
        $job = job::find($id);
        return view('job.updatecode',compact('job'));
    }

    public function updatecode(JobCodeRequest $request,$id)
    {
         $job = job::find($id);
         $job->job_code = $request->job_code;
         $job->save();
         return redirect('/job')->with("message",trans('app.update_sucessfully'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = job::find($id);
        $job->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));

    }
    public function search(Request $request)
    {
         $search_title =  $request->title;
         $jobs = job::where('title', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         return view('job.index',compact('jobs'));
    }




}
