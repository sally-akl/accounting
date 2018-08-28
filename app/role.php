<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{

    protected $fillable = [
      'title'
    ];

     public function permission()
     {
        return $this->belongsToMany('App\permission', 'roles_permissions');
     }

     public function users()
     {
        return $this->belongsToMany('App\User', 'users_roles');
     }
}
