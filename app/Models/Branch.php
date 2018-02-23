<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Database;
use Illuminate\Database\Eloquent\SoftDeletes;


class Branch extends Model
{
   
  use SoftDeletes;

  use Database;

  /**
   * The branches that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  /**
  * The branches that are mass assignable.
  *
  * @var array
  */
  protected $fillable = ['code', 'name', 'address'];

  /**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    return $this->persist( Branch::class, $data);  
  }

  /**
   * The service type
   */
  public function serviceTypes()
  {
      return $this->belongsToMany('App\Models\ServiceType')
             ->withPivot('order')
             ->orderBy('branch_service_type.order', 'asc');
  }

  /**
  * Get branches list
  * 
  */
  public static function list(){
    return Branch::orderBy('name')->get();
  }

  /**
   * Order up the branch on the service type
   * 
   * @param App\Models\ServiceType $serviceType 
   */
  public function orderUp( ServiceType $serviceType ){

    $serviceType->load("branches");

    //Get the branch associated the service type
    $branches = $serviceType->branches()->get();

    //Get the actual item
    $actualItem = $branches->filter( function($value){
      return $this->id == $value->id;
    })->first(); 

    //Get the previous item 
    $previousItem = $this->getItem( $branches, $actualItem, -1 );

    //If the item can be moved switch the elements
    if( isset($previousItem) ){

      $this->switchItems($serviceType, $actualItem, $previousItem );
      
    }
  }

  /**
  * Order down the branch on the service type
  * 
  * @param App\Models\ServiceType $serviceType 
  * 
  */
  public function orderDown( ServiceType $serviceType ){

    $serviceType->load("branches");

    //Get the branches associated the service type
    $branches = $serviceType->branches()->get();

    //Get the actual item
    $actualItem = $branches->filter( function($value){
      return $this->id == $value->id;
    })->first(); 

    //Get the next item 
    $nextItem = $this->getItem( $branches, $actualItem, 1 );

    //If the item can be moved switch the elements
    if( isset( $nextItem ) ){

      $this->switchItems($serviceType, $actualItem, $nextItem );

    }
  }


  /**
  * Get an branches moved position elements relative to the branche
  * 
  * @param Illuminate\Database\Eloquent\Collection $collection the collection of items
  * @param App\Models\Branch $item 
  * @param int $position the relative position
  */
  function getItem($collection, $item, $position){

    return $collection->filter( function($value) use ($item, $position) {
        return $item->pivot->order + $position  == $value->pivot->order;
    })->first();

  }

  /**
  * Switch two branches on a specific service type
  * 
  * @param App\Models\ServiceType $serviceType The service type
  * @param App\Models\branch $item1 
  * @param App\Models\branch $item2
  * 
  */
  function switchItems( $serviceType, $item1, $item2){
    
    $serviceType->branches()->updateExistingPivot($item1->id, ['order' =>  $item2->pivot->order ] );

    $serviceType->branches()->updateExistingPivot($item2->id, ['order' =>  $item1->pivot->order ] );

  }
  
}
