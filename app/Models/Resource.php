<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	/**
   * The service type
   */
  public function services()
  {
  	return $this->hasMany('App\Models\Service');
  }
}
