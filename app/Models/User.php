<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

class User extends Model
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
    return $this->persist( User::class, $data);		
  }

  /**
  * The roles related to the service type
  */
  public function roles()
  {
      return $this->belongsToMany('Silber\Bouncer\Database\Role')
             ->withPivot('order')
             ->orderBy('role_user.order', 'asc');
  }

  /**
  * The branches related to the service type
  */
  public function branches()
  {
      return $this->belongsToMany('App\Models\Branch')
             ->orderBy('branch_service_type.id', 'asc');
  }

  /**
  * Service type task's
  */
  public function tasks()
  {
      return $this->hasMany('App\Models\Task')->orderBy('order');
  }

  /**
  * The next order of serviceType's attribute
  */
  public function nextRoleOrder()
  {

    return $this->roles()->get()->count() > 0  ?  
           $this->roles()->get()->last()->pivot->order + 1 : 1 ;
    
  }

  /**
  * The next order of serviceType's task
  */
  public function nextTaskOrder()
  {
      return $this->tasks()->max('order') + 1 ;
  }

  /**
  * The next order of serviceType's branch
  */
  public function nextBranchOrder()
  {
      return $this->branches()->max('order') + 1 ;
  }

  /**
  * Get attribute's types list
  * 
  */
  public static function list(){
    return ServiceType::orderBy('name')->get();
  }

}
