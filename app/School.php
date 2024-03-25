<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
   protected $table = 'schools';
   public function blocks()
    {
    	return $this->belongsTo('App\Block','block_id');
    }
	public function pincodes()
    {
    	return $this->belongsTo('App\Pincode','pincode_id');
    }
}
