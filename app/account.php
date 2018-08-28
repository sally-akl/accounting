<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{

    protected $fillable = [
      'bank_name', 'account_number', 'branch_location','branch_city','open_balance'
    ];

    public function customers()
    {
       return $this->belongsToMany('App\customer', 'accounts_persons');
    }

    public function emplyees()
    {
       return $this->belongsToMany('App\employee', 'accounts_persons');
    }
    public function transactions()
    {
       return $this->hasMany('App\transaction','account_to_id');
    }


}
