<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class major extends Model
{
    protected $fillable = [
      'title','category_id'
    ];

    protected $table = "major";

    public function category()
    {
         return $this->belongsTo('App\category');
    }

    public function emplyee_major_data()
    {
         return $this->hasMany('App\emplyee_major');
    }
}
