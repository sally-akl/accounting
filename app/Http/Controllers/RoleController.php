<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\module;
use App\permission;
use App\role;
use App\User;
use App\rolepermission;
use Session;
class RoleController extends Controller
{


    protected $pagination_num = 10;
    public function index()
    {
        $roles = role::where('id','!=',1)->orderBy("id","desc")->paginate($this->pagination_num);
        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        return view('roles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $role = new role();
         $role->title = $request->title;
         $role->save();
         return redirect('/roles/permissions/'. $role->id);
         return redirect('/roles')->with("message",trans('app.add_sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = role::find($id);
        return view('roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = role::find($id);
        return view('roles.update',compact('role'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = role::find($id);
        $role->title = $request->title;
        $role->save();
        return redirect('/roles/permissions/'. $role->id);
        //return redirect('/roles')->with("message",trans('app.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = role::find($id);
        $role->delete();
        Session::put('message', trans('app.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }


    public function createpermission()
    {
        $modules = module::all();
        return view('roles.addpermission',compact('modules'));
    }

    public function storepermission(Request $request)
    {
         $permission = new permission();
         $permission->title = $request->title;
         $permission->code = $request->code;
         $permission->module_id = $request->module_id;
         $permission->save();
         return redirect('/roles/createpermission');
    }

    public function user_roles($id)
    {
        $role = role::find($id);
        $user_roles = $role->users;
        $users = user::where('id','!=',1)->get();
        return view('roles.user_roles',compact('user_roles','role','users'));
    }

    public function permissions($id)
    {
        $permissions = permission::orderBy("module_id","asc")->get();
        $role = role::find($id);
        $saved_permissions = rolepermission::where('role_id',$id)->get();
        $permission = array();
        foreach(  $saved_permissions as $s_per)
        {
           $permission[] = $s_per->permission_id;
        }

        return view('roles.permissions',compact('permissions','role','permission'));
    }

    public function store_permissions(Request $request)
    {
        if(is_array($request->permission) && count($request->permission) > 0)
        {
           $role_permissions = rolepermission::where('role_id',$request->role_val);
           $role_permissions->delete();
           $new_permissions = $request->permission;
           foreach($new_permissions as $perm)
           {
               $role_permissions = new rolepermission();
               $role_permissions->role_id = $request->role_val;
               $role_permissions->permission_id = $perm;
               $role_permissions->save();
           }
           return redirect('/roles')->with("message",trans('app.add_sucessfully'));
        }
    }




}
