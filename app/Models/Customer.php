<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

class Customer extends Model
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
  protected $fillable = ['code', 'firstname', 'lastname', 'email', 'address', 'phone', 'category_id'];

  /**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    return $this->persist( Customer::class, $data);  
  }

  /**
  * The categories related to the customer
  */
  public function categories()
  {
      return $this->belongsto('App\Models\Category');
  }

  /**
  * The next order of serviceType's task
  */
  public function nextCategoryOrder()
  {

    return $this->categories()->max('order') + 1 ;
    
  }

}
