<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

class Role extends Model
{

  use SoftDeletes;

  use Database;

  /**
   * The roles that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  /**
  * The roles that are mass assignable.
  *
  * @var array
  */
  protected $fillable = ['code', 'name'];

  /**
  * Get roles list
  * 
  */
  public static function list(){
  	return Role::orderBy('name')->get();
  }

  /**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    return $this->persist( Role::class, $data);  
  }

  /**
   * Order up the role on the user
   * 
   * @param App\Models\User $user 
   */
  public function orderUp( User $user ){

  	$user->load("roles");

  	//Get the roles associated the user type
  	$roles = $user->roles()->get();

  	//Get the actual item
  	$actualItem = $roles->filter( function($value){
  		return $this->id == $value->id;
  	})->first(); 

  	//Get the previous item 
  	$previousItem = $this->getItem( $roles, $actualItem, -1 );

  	//If the item can be moved switch the elements
  	if( isset($previousItem) ){

  		$this->switchItems($user, $actualItem, $previousItem );
  		
  	}
  }

  /**
  * Order down the role on the user
  * 
  * @param App\Models\User $user 
  * 
  */
  public function orderDown( User $user ){

  	$user->load("roles");

  	//Get the roles associated the user
  	$roles = $user->roles()->get();

  	//Get the actual item
  	$actualItem = $roles->filter( function($value){
  		return $this->id == $value->id;
  	})->first(); 

  	//Get the next item 
  	$nextItem = $this->getItem( $roles, $actualItem, 1 );

  	//If the item can be moved switch the elements
  	if( isset( $nextItem ) ){

  		$this->switchItems($user, $actualItem, $nextItem );

  	}
  }


  /**
  * Get an role moved position elements relative to the role
  * 
  * @param Illuminate\Database\Eloquent\Collection $collection the collection of items
  * @param App\Models\Role $item 
  * @param int $position the relative position
  */
  function getItem($collection, $item, $position){

  	return $collection->filter( function($value) use ($item, $position) {
  			return $item->pivot->order + $position  == $value->pivot->order;
  	})->first();

  }

  /**
  * Switch two roles on a specific user type
  * 
  * @param App\Models\User $user The user
  * @param App\Models\Role $item1 
  * @param App\Models\Role $item2
  * 
  */
  function switchItems( $user, $item1, $item2){
  	
  	$user->roles()->updateExistingPivot($item1->id, ['order' =>  $item2->pivot->order ] );

  	$user->roles()->updateExistingPivot($item2->id, ['order' =>  $item1->pivot->order ] );

  }


}
