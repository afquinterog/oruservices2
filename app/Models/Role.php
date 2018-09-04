<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

class Role extends Model
{

  // use SoftDeletes;

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


}
