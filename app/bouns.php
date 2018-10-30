<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bouns extends Model
{

    protected $fillable = [
      'emp_major_id', 'employee_id', 'bonus_date','bonus_amount'
    ];

    protected $table = "bonus";
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
