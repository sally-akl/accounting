<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TemplateRequest;
use App\templates;
class TemplatesController extends Controller
{

    protected $pagination_num = 10;
    public function index()
    {
        $templates = templates::orderBy("id","desc")->paginate($this->pagination_num);
        return view('templates.index',compact('templates'));
    }

    public function edit($id)
    {
        $template = templates::find($id);
        return view('templates.update',compact('template'));
    }

    public function update(TemplateRequest $request,$id)
    {
        $template = templates::find($id);
        $template->title = $request->title;
        $template->content = $request->body;
        $template->save();
        return redirect('/templates')->with("message",trans('app.update_sucessfully'));
    }

}
