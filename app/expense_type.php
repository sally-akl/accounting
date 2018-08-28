<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expense_type extends Model
{

    protected $fillable = [
      'title'
    ];

    protected $table = "expense_type";

    public function transactions()
    {
       return $this->hasMany('App\transaction');
    }
}
