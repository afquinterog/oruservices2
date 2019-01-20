<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Database;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Facades\App\Models\ServiceWorkflow;
use Facades\App\Models\ServiceTransition;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Service extends Model implements Auditable
{
	use Database;

  use AuditableTrait;

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
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    //'custom' => 'collection',
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
  * The resource
  */
  public function resource()
  {
    return $this->belongsTo('App\Models\Resource');
  }

  /**
   * The service status
   */
  public function status()
  {
  	return $this->belongsTo('App\Models\ServiceStatus', 'service_status_id');
  }

  /**
   * Get the service date
   *
   * @param array $data 
   */
  public function getDate(){
    return explode(" ", $this->service_date)[0];
  }

  /**
   * Get the service time
   *
   * @param array $data 
   */
  public function getTime(){
    return explode(" ", $this->service_date)[1];
  }

  /**
   * Get the service custom data in the proper order
   *
   * @param  array $data
   * @return Collection data
   */ 
  public function getCustomAttribute($value)
  {
    $value = json_decode($value);
    return collect($value)->sortKeys();
  }

  /**
   * Set the service custom data in order
   *
   * @param  array $data
   * @return Collection data
   */
  public function setCustomAttribute($value)
  {
    $this->attributes['custom'] = json_encode(collect($value)->sortKeys());
  }

  /**
   * Get additional service data 
   *
   * @param  Service $service
   * @return Service $service with additional data
   */
  public function getAdditionalData( $service )
  {
    //load relations
    $service->load("serviceType.attributes", "audits.user");

    //Get the service custom data and link to attributes
    $this->getAttributeValues( $service);

    //Get service changes
    $this->getServiceChanges( $service );

    //Get service transitions
    $service->transitions = $this->getServiceTransitions($service);

    return $service;
  }

  /**
   * Get the service changes
   *
   * @param  Service $service
   * @return Service $service
   */
  public function getServiceChanges($service)
  {
    foreach( $service->audits as $change){
      //rint_r($change->old_values);
      $collection1 = collect($change->old_values);
      $collection2 = collect($change->new_values);  

      $oldData = "";
      foreach( $collection1 as $key => $item){
        $oldData .= $key . "=>" . $item;
      }
      $change->oldData = $oldData;

      $newData = "";
      foreach( $collection2 as $key => $item){
        $newData .= $key . "=>" . $item;
      }
      $change->newData = $newData;

      
      $result = $collection2->diffAssoc($collection1);
      $change->differences = $result;
    }
  }

  /**
   * Get the service transitions
   *
   * @param  Service $service
   * @return Service $service
   */
  public function getServiceTransitions($service)
  {
    $workflow = ServiceWorkflow::defineServiceWorkflow();
    $transitions = $workflow->getEnabledTransitions($service);
    
    foreach($transitions as $transition){
      $serviceTransition = ServiceTransition::where('transition', '=', $transition->getName() )->first();
      $transition->description = $serviceTransition->description;
    }

    return $transitions;

  }

  /**
   * Load service attributes and append actual values
   *
   * @param  array $data
   * @return Collection data
   */
  public function getAttributeValues($service)
  {
    //Set service attributes and values
    $service->customAttributes = $service->serviceType->attributes()->get();
    
    foreach( $service->customAttributes as $item){
      $attributeName = $item->code ;
      $item->value = $service->custom->get($attributeName) ?? "";
    }
  }

  /**
   * Process the data before is saved to database
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

    

    return $data; 
  }


	/**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    //Get transition
    if( isset($data['transition']) ){
      $transition = $data['transition'];
      unset($data['transition']); 
    } 
    
    $data = $this->beforeSave($data);

    $service = $this->persist( Service::class, $data);

    //Apply service transition
    if( isset($transition) ){
      $workflow = ServiceWorkflow::defineServiceWorkflow();
      $workflow->apply($service, $transition );

      //Set the new status
      $service->service_status_id = $this->getServiceStatusId($service);
    }
    
    $service = $this->persist( Service::class, $service->toArray() );

    return $service;

  }

  /**
   * Get the service status
   *
   * @param Service $service
   * @return  service status id
   */
  public function getServiceStatusId($service)
  {
    $data = ServiceStatus::where('code', '=', $service->state)->first();
    return $data->id;
  }


   /**
   * Get services 
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
    //                "branch_id", "service_status_id");
    
    // $query = Service::select( $fields);

    // $query->leftjoin("service_types", "services.service_type_id", "=", "service_types.id");
    // $query->leftjoin("customers", "services.customer_id", "=", "customers.id");
    // $query->leftjoin("branches", "services.branch_id", "=", "branches.id");

    // if( is_numeric($search)){
    //  $query->orWhere("services.id" , "=", $search);
    // }

    // $query->orWhere('services.code', 'LIKE', $filter );
    // $query->orWhere("service_types.name" , "LIKE", $filter);
    // $query->orWhere("customers.firstname" , "LIKE", $filter);
    // $query->orWhere("customers.lastname" , "LIKE", $filter);
    // $query->orWhere("customers.code" , "LIKE", $filter);
    // $query->orWhere("branches.name" , "LIKE", $filter);


   //   return $query->orderBy("services.id","desc")->paginate( 10 );

  }


}
