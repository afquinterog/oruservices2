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
      return $this->belongsToMany('App\Models\ServiceType');
  }
  
}
