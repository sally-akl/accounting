<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','branch_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $main_role = "admin";

    public $branches;
    public $active_branch;

    public function roles()
    {
       return $this->belongsToMany('App\role', 'users_roles','user_id','role_id');
    }

    public function hasChildRoles()
    {
        $child_roles =   $this->roles()->join("roles as r","role_id","r.parent")->get();
        if(count($child_roles) > 0)
         return true;
        return false;
    }

    public function branche()
    {
        return $this->belongsToMany('App\branch', 'user_branches','user_id','branch_id');
    }
    public function getAdminBranchesIds()
    {
        $ids = array();
        $br = $branches = \App\branch::all();
        foreach($br as $branch)
        {
            $ids[] =  $branch->id;
        }
        return $ids;
    }

    public function getBranchesIds()
    {
        $ids = array();
        foreach($this->branche as $branch)
        {
            $ids[] =  $branch->id;
        }
        return $ids;
    }



    public function UserHasRole($role)
    {
        if($this->roles()->where("title",$role)->first())
           return true;
        return false;
    }

    public function IsAdmin()
    {
       return $this->UserHasRole($this->main_role);
    }


    public function AllowToPath($permission)
    {
         $active_role="";
         $roles = $this->roles;
         foreach($roles as $role)
         {
              $user_permissions =$role->permission;
              if($user_permissions)
              {
                  if(is_array($permission))
                  {
                     foreach ($permission as $p) {
                       if($user_permissions->where("code",$p)->first())
                        return true;
                     }
                  }
                  else
                  if($user_permissions->where("code",$permission)->first())
                   return true;
              }

         }
         return false;
    }




}
