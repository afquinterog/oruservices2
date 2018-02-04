<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

class Task extends Model
{

  use SoftDeletes;

  use Database;

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['name', 'order'];
	 
	/**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

	/**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    return $this->persist( Task::class, $data);		
  }

	/**
	* The task 
	*/
	public function task()
	{
		return $this->belongsTo('App\Models\ServiceType');
	}

	/**
	* Order up the task on the service type
	* 
	* @param App\Models\ServiceType $serviceType 
	*/
	public function orderUp( ServiceType $serviceType ){

		$serviceType->load("tasks");

		//Get the tasks associated the service type
		$tasks = $serviceType->tasks()->get();

		//Get the actual item
		$actualItem = $tasks->filter( function($value){
			return $this->id == $value->id;
		})->first(); 

		//Get the previous item 
		$previousItem = $this->getItem( $tasks, $actualItem, -1 );

		//If the item can be moved switch the elements
		if( isset($previousItem) ){

			$this->switchItems($serviceType, $actualItem, $previousItem );

		}
	}

	/**
	* Order down the task on the service type
	* 
	* @param App\Models\ServiceType $serviceType 
	* 
	*/
	public function orderDown( ServiceType $serviceType ){

		$serviceType->load("tasks");

		//Get the tasks associated the service type
		$tasks = $serviceType->tasks()->get();

		//Get the actual item
		$actualItem = $tasks->filter( function($value){
			return $this->id == $value->id;
		})->first(); 

		//Get the next item 
		$nextItem = $this->getItem( $tasks, $actualItem, 1 );

		//If the item can be moved switch the elements
		if( isset( $nextItem ) ){

			$this->switchItems($serviceType, $actualItem, $nextItem );

		}
	}

	/**
	* Get an task moved position elements relative to the task
	* 
	* @param Illuminate\Database\Eloquent\Collection $collection the collection of items
	* @param App\Models\task $item 
	* @param int $position the relative position
	*/
	function getItem($collection, $item, $position){

		return $collection->filter( function($value) use ($item, $position) {

				return $item->order + $position  == $value->order;
				
		})->first();

	}

	/**
	* Switch two tasks on a specific service type
	* 
	* @param App\Models\ServiceType $serviceType The service type
	* @param App\Models\Task $item1 
	* @param App\Models\Task $item2  
	* 
	*/
	function switchItems( $serviceType, $item1, $item2){

		$serviceType->tasks()->where('id', $item1->id)
												 ->first()
		            				 ->update(['order' =>  $item2->order ] );

		$serviceType->tasks()->where('id', $item2->id)
		                     ->first()
		                     ->update(['order' =>  $item1->order ] );

	}


}
