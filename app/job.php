<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    protected $fillable = [
      'title','job_code','category_id','default_salary'
    ];

    public function users()
    {
        return $this->belongsTo('App\User',"user_id");
    }
    public function category()
    {
         return $this->belongsTo('App\category');
    }



}
