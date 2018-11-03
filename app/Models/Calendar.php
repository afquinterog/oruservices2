<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Calendar extends Model
{

	/**
	 * Get the services by resource
	 * 
	 */
	public function getServicesByResource($initialDate, $finalDate, $serviceType, $resource="")
	{
		
		$services = Service::where('service_date', '>=', $initialDate)
									->where('service_date', '<=', $finalDate )
									->where('service_type_id', '=' , $serviceType );

		if( $resource != ""){
			$services->where('resource_id', '=', $resource );
		}

		$services = $services->get();

		$services = $this->formatServicesForCalendar($services);

		return $services;
	}


	/**
	 * Get previous sunday
	 */
	public function getPreviousSunday($date)
	{
		//return Carbon::now()->startOfWeek();
		return Carbon::createFromFormat('Y-m-d', $date )->startOfWeek();
	}

	public function formatServicesForCalendar($services)
	{

		$calendarServices = "";

		foreach ($services as $service){
			$name = $service->customer->name();
			$date = str_replace(" ", "T", $service->service_date);

			$description = $service->customer->phone . "<br/>" .
				$service->customer->category->description . "<br/>" .
				"Servicios : " . $service->customer->servicesCount() . "<br/>";

			$calendarServices .= "
				{
		      title  : '{$name}' ,
		      description : '{$description}',
		      url: '/services/edit/{$service->id}',
		      start  : '{$date}',
		      backgroundColor: '{$service->serviceType->color}' ,
		    },
		  ";
		}
		
		return $calendarServices;
	}
}
