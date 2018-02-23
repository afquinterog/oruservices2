<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

class Attribute extends Model
{

  use SoftDeletes;

  use Database;

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = ['name', 'attribute_type_id', 'active'];

	/**
   * The attribute type 
   */
  public function attributeType()
  {
      return $this->belongsTo('App\Models\AttributeType');
  }
    
  /**
   * The service type linked to a specific attribute
   */
  public function serviceTypes()
  {
      return $this->belongsToMany('App\Models\ServiceType');
  }

  /**
  * Get attributes list
  * 
  */
  public static function list(){
  	return Attribute::orderBy('name')->get();
  }

  /**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    return $this->persist( Attribute::class, $data);  
  }

  /**
   * Order up the attribute on the service type
   * 
   * @param App\Models\ServiceType $serviceType 
   */
  public function orderUp( ServiceType $serviceType ){

  	$serviceType->load("attributes.attributeType");

  	//Get the attributes associated the service type
  	$attributes = $serviceType->attributes()->get();

  	//Get the actual item
  	$actualItem = $attributes->filter( function($value){
  		return $this->id == $value->id;
  	})->first(); 

  	//Get the previous item 
  	$previousItem = $this->getItem( $attributes, $actualItem, -1 );

  	//If the item can be moved switch the elements
  	if( isset($previousItem) ){

  		$this->switchItems($serviceType, $actualItem, $previousItem );
  		
  	}
  }

  /**
  * Order down the attribute on the service type
  * 
  * @param App\Models\ServiceType $serviceType 
  * 
  */
  public function orderDown( ServiceType $serviceType ){

  	$serviceType->load("attributes.attributeType");

  	//Get the attributes associated the service type
  	$attributes = $serviceType->attributes()->get();

  	//Get the actual item
  	$actualItem = $attributes->filter( function($value){
  		return $this->id == $value->id;
  	})->first(); 

  	//Get the next item 
  	$nextItem = $this->getItem( $attributes, $actualItem, 1 );

  	//If the item can be moved switch the elements
  	if( isset( $nextItem ) ){

  		$this->switchItems($serviceType, $actualItem, $nextItem );

  	}
  }


  /**
  * Get an attribute moved position elements relative to the attribute
  * 
  * @param Illuminate\Database\Eloquent\Collection $collection the collection of items
  * @param App\Models\Attribute $item 
  * @param int $position the relative position
  */
  function getItem($collection, $item, $position){

  	return $collection->filter( function($value) use ($item, $position) {
  			return $item->pivot->order + $position  == $value->pivot->order;
  	})->first();

  }

  /**
  * Switch two attributes on a specific service type
  * 
  * @param App\Models\ServiceType $serviceType The service type
  * @param App\Models\Attribute $item1 
  * @param App\Models\Attribute $item2
  * 
  */
  function switchItems( $serviceType, $item1, $item2){
  	
  	$serviceType->attributes()->updateExistingPivot($item1->id, ['order' =>  $item2->pivot->order ] );

  	$serviceType->attributes()->updateExistingPivot($item2->id, ['order' =>  $item1->pivot->order ] );

  }


}
