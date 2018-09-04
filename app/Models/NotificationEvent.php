<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationEvent extends Model
{
	/**
  * Get notification event list
  * 
  */
  public static function list(){
  	return NotificationEvent::orderBy('id')->get();
  }
}
