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

}
