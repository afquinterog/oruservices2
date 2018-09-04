<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Database;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Service extends Model
{
	use Database;

	/**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'service_date'
    ];



  /**
  * The service type
  */
  public function serviceType()
  {
  	return $this->belongsTo('App\Models\ServiceType');
  }

  /**
  * The customer
  */
  public function customer()
  {
  	return $this->belongsTo('App\Models\Customer');
  }

  /**
  * The branch
  */
  public function branch()
  {
  	return $this->belongsTo('App\Models\Branch');
  }

  /**
  * The service status
  */
  public function status()
  {
  	return $this->belongsTo('App\Models\ServiceStatus', 'service_status_id');
  }


  public function processData( $service )
  {
    //load relations
    $service->load("serviceType.attributes");

    $service->data = json_decode( $service->data );

    //Get attributes
    $service->customAttributes = $service->serviceType->attributes()->get();
    
    foreach( $service->customAttributes as $item){
      $attributeName = $item->code ;
      $item->value = $service->data->$attributeName ?? "";
    }
    
    return $service;
  }
  


  /**
   * Save or update the model information
   *
   * @param array $data 
  */
  public static function list($data)
  {

  	$search = isset($data['filter']) ?: "";
  	$filter = allQueryFormat( $search );

    //print_r( Auth::user()->branches );
    //exit;
    //return Auth::user()->roles();

    //Get services 
    $services = Service::with(['serviceType', 'customer', 'branch','status'])
                        ->where('id', '=', $filter )
                        ->orWhere('services.code', 'LIKE', $filter )
                        //->orWhere("serviceType.name" , "LIKE", $filter)
                        //->orWhere("customers.firstname" , "LIKE", $filter)
                        //->orWhere("customers.lastname" , "LIKE", $filter)
                        //->orWhere("customers.code" , "LIKE", $filter)
                        //->orWhere("branches.name" , "LIKE", $filter)
                        ->orderBy("services.id", "desc" )
                        ->where( 'company_id', '=', Auth::user()->company->id );

    if( is_numeric($search)){
      $services->orWhere("services.id" , "=", $search);
    }

    $services = $services->orderBy("services.id","desc")->paginate( 10 );

    return $services;


  	// $fields = array("services.id as id", 'service_date', "service_type_id", "customer_id", 
  	// 								"branch_id", "service_status_id");
  	
  	// $query = Service::select( $fields);

  	// $query->leftjoin("service_types", "services.service_type_id", "=", "service_types.id");
  	// $query->leftjoin("customers", "services.customer_id", "=", "customers.id");
  	// $query->leftjoin("branches", "services.branch_id", "=", "branches.id");

  	// if( is_numeric($search)){
  	// 	$query->orWhere("services.id" , "=", $search);
  	// }

  	// $query->orWhere('services.code', 'LIKE', $filter );
  	// $query->orWhere("service_types.name" , "LIKE", $filter);
  	// $query->orWhere("customers.firstname" , "LIKE", $filter);
  	// $query->orWhere("customers.lastname" , "LIKE", $filter);
  	// $query->orWhere("customers.code" , "LIKE", $filter);
  	// $query->orWhere("branches.name" , "LIKE", $filter);


   // 	return $query->orderBy("services.id","desc")->paginate( 10 );

  }

  /**
   * Process data 
   *
   * @param array $data 
   */
  public function beforeSave(array $data)
  {

    //Get time from ui to model
    $dateTime = $data['service_date'] . " " . $data['time'] ;
    $dt = Carbon::parse( $dateTime );
    $data['service_date'] = $dt->toDateTimeString() ;
    unset( $data['time'] );

    //Encode service attributes
    $data['data'] = json_encode( $data['data'] );

    return $data; 
  }


	/**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    $data = $this->beforeSave($data);

    //Check services changes and get the change string for the history
    $changes = $this->checkChanges($request->all());
        
    return $this->persist( Service::class, $data);		
  }

  public function getDate(){
  	return explode(" ", $this->service_date)[0];
  }

  public function getTime(){
  	return explode(" ", $this->service_date)[1];
  }

  public function checkChanges($data){
    //Revisar si camgio fecha hora
    //Revisar si cambio cliente
    //Revisar si cambio sucursal
    //Revisar si cambio la asignacion 
    //Revisar si camnbiaron los atributos
  }

}
