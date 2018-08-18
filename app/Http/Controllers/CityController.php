<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Models\City;

class CityController extends Controller
{

	public function find(Request $request)
  {
  	$filter = $request->get('filter');

  	return City::find( $filter );
  }
}
