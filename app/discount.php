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

}
