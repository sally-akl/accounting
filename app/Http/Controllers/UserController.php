<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\role;
use App\userrole;
use App\Http\Requests\UserRequest;
use Session;
class UserController extends Controller
{

    protected $pagination_num = 10;
    public function index()
    {
         $user = User::where('id','!=',1)->orderBy("id","desc")->paginate($this->pagination_num);
         return view('user.index',compact('user'));
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show',compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.update',compact('user'));
    }
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/user')->with("message",trans('app.update_sucessfully'));
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
    public function search(Request $request)
    {
         $search_title =  $request->email;
         $user = User::where('email', 'like', '%' . $search_title . '%')->orderBy("id","desc")->paginate($this->pagination_num);
         return view('user.index',compact('user'));
    }

    public function user_roles($id)
    {
        $user = User::find($id);

        $user_roles = $user->roles;
        $roles = role::where('id','!=',1)->get();
        return view('user.user_roles',compact('user_roles','user','roles'));
    }

    public function user_role_store(Request $request)
    {
       if(is_array($request->user_val))
       {
           $users = $request->user_val;
           foreach($users as $user)
           {
              $this->InsertUserRole($user,$request->role_name);
           }
           return redirect('/roles')->with("message",trans('app.add_sucessfully'));

       }
       else {
            if($this->InsertUserRole($request->user_val,$request->role_name))
               return redirect('/user')->with("message",trans('app.add_sucessfully'));

            return redirect('/user')->with("message",trans('app.error_exist'));
       }

    }

    protected function InsertUserRole($user_id , $role_id)
    {
        $user = User::find($user_id);
        if($user != null)
        {
           $user_roles = userrole::where('user_id',$user_id)->where('role_id', $role_id);
           $user_roles->delete();

           $user_roles = new userrole();
           $user_roles->user_id = $user_id;
           $user_roles->role_id =  $role_id;
           $user_roles->save();
           return true;
         }

         return false;


    }



}
