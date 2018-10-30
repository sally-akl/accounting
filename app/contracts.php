<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contracts extends Model
{

    protected $fillable = [
      'begin_date','end_date','content','title','for_type','for_type_id','branch_id','user_id'
    ];
    protected $table = "contracts";
    public function users()
    {
        return $this->belongsTo('App\User',"user_id");
    }

}
