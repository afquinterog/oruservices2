<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

class ServiceType extends Model
{

	use ValidatesRequests;

  use SoftDeletes;

  use Database;

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [ ];

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
    return $this->persist( ServiceType::class, $data);		
  }

  /**
  * The attributes related to the service type
  */
  public function attributes()
  {
      return $this->belongsToMany('App\Models\Attribute')
             ->withPivot('order')
             ->orderBy('attribute_service_type.order', 'asc');
  }

  /**
  * Service type task's
  */
  public function tasks()
  {
      return $this->hasMany('App\Models\Task')->orderBy('order');
  }

  /**
  * The next order of serviceType's task
  */
  public function nextAttributeOrder()
  {

    return $this->attributes()->get()->count() > 0  ?  
           $this->attributes()->get()->last()->pivot->order + 1 : 1 ;
    
  }

  /**
  * The next order of serviceType's task
  */
  public function nextTaskOrder()
  {
      return $this->tasks()->max('order') + 1 ;
  }

  /**
  * Get attribute's types list
  * 
  */
  public static function list(){
    return ServiceType::orderBy('name')->get();
  }


}
