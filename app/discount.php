<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discount extends Model
{

    protected $fillable = [
      'emp_major_id','employee_id','discount_date','discount_amount'
    ];

    protected $table="discount";

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
