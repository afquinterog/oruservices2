<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

  
	public function departments()
	{
  	return $this->hasMany('App\Models\Departments');
  }


}
