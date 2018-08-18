<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

	public function department()
	{
  	return $this->belongsTo('App\Models\Department');
  }


  public function find($request)
  {
  	return City::where('cities.name', 'LIKE', '%' . $request . '%' )
  							->orWhere('departments.name', 'LIKE', '%' . $request . '%' )
  							->orWhere('countries.name', 'LIKE', '%' . $request . '%' )
  							->leftJoin('departments', 'cities.deparment_id', '=', 'departments.id')
  							->leftJoin('countries', 'departments.country_id', '=', 'countries.id' )
  							->select('cities.*', 'departments.name as departmentName', 'countries.name as countryName' )
  							->get();
  }
}
