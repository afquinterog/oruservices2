<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
	/**
  * Get notification type list 
  * 
  */
  public static function list(){
  	return NotificationType::orderBy('id')->get();
  }
}
