<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class extra_mis_salaries extends Model
{
    protected $table = "extra_minis_salaries";
    public function users()
    {
        return $this->belongsTo('App\User',"user_id");
    }
}
