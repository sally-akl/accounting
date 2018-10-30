<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\branch;
use App\user_branches;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('language');

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        $action = $request->query("action")?$request->query("action"):"";
        $role = $request->query("role")?$request->query("role"):"";
        $branches = branch::all();
        return view('auth.register',["action"=>$action,"role"=>$role,"branches"=>$branches]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'branch_name'=>'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $selected_branches = $request->branch_name;
        foreach($selected_branches as $branch)
        {
            $user_branches = new user_branches();
            $user_branches->user_id =  $user->id;
            $user_branches->branch_id =  $branch;
            $user_branches->save();
        }

        if($request->action == "new_user")
          return redirect('roles/user/'. $request->role."/".app()->getLocale()."?branch=".$request->query('branch'));

        return redirect('user/roles/'. $user->id."/".app()->getLocale()."?branch=".$request->query('branch'));
      /*  return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());  */
    }
}
