<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTypeNotification extends Model
{

  /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'notification_event_id', 'notification_type_id', 'destiny'
	];


	/**
  * The notification event
  */
  public function event()
  {
      return $this->belongsTo('App\Models\NotificationEvent' , 'notification_event_id');
  }

  /**
  * The notification event type
  */
  public function eventType()
  {
      return $this->belongsTo('App\Models\NotificationType' , 'notification_type_id');
  }

}
