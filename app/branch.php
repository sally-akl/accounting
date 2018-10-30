<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{

    protected $fillable = [
      'branch_code', 'branch_title','address','phone','email','city_id'
    ];

    public function Users()
    {
        return $this->hasMany('App\User');
    }

    public function categories()
    {
        return $this->hasMany('App\category');
    }

}
