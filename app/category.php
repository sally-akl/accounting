<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{

    protected $fillable = [
      'title', 'category_code', 'parent_id'
    ];

     public function majors()
     {
         return $this->hasMany('App\major');
     }

     public function branch()
     {
         return $this->belongsTo('App\branch');
     }
     public function users()
     {
         return $this->belongsTo('App\User',"user_id");
     }
}
