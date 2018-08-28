<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $fillable = [
      'title','code','module_id'
    ];

    public function modules()
    {
       return $this->belongsTo('App\module');
    }
    public function roles()
    {
       return $this->belongsToMany('App\role', 'roles_permissions');
    }


}
