<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Models\Calendar;
use App\Models\ServiceType;

class CalendarController extends Controller
{
 /**
  * Display the calendar
  *
  * @return \Illuminate\Http\Response
  */
	public function index(Request $request)
	{
    
    $initialDate = $request->get('date', \Carbon\Carbon::now() );
    $actualServiceType = $request->get('actualServiceType', '1');

    $startDate = Calendar::getPreviousSunday( $initialDate );
    $finalDate = Calendar::getPreviousSunday( $initialDate )->addDays(7);
    
    //Get the services since $initialDate
    $services = Calendar::getServicesByResource($startDate, $finalDate, $actualServiceType );

    //Get the available service types 
    $serviceTypes = ServiceType::where('active', 1)->get();

    return view('calendar.index', compact('startDate', 'services', 'serviceTypes', 'actualServiceType') );
	}
}
