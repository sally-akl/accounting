<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
      protected $fillable = [
        'title','service_code','parent_id'
      ];

      public function invoices()
      {
          return $this->belongsToMany('App\invoice', 'invoice_items');
      }
      public function users()
      {
          return $this->belongsTo('App\User',"user_id");
      }
      public function category()
      {
           return $this->belongsTo('App\category');
      }


}
