<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class extra_salary extends Model
{

    protected $fillable = [
      'title','emp_major_id','extra_amount'
    ];

    protected $table = "extra_salary";

    public function employeeMajorData()
    {
         return $this->belongsTo('App\emplyee_major','emp_major_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User',"user_id");
    }
    public function extra_min()
    {
         return $this->belongsTo('App\extra_mis_salaries','extra_minus_id');
    }

}
