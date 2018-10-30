<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_branches extends Model
{
    protected $fillable = [
      'user_id','branch_id'
    ];
}
