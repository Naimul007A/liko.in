<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
   protected $table = 'pincodes';
   public function cities()
    {
    	return $this->belongsTo('App\City','city_id');
    }
}
