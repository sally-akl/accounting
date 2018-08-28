<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class module extends Model
{
    protected $fillable = [
      'title'
    ];

    public function permission()
    {
        return $this->hasMany('App\permission');
    }
}
