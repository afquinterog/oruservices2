<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

use Nicolaslopezj\Searchable\SearchableTrait;

class Customer extends Model
{
   
  use SoftDeletes;

  use Database;

  use SearchableTrait;

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
  protected $guarded = [];


  /**
   * Searchable configuration
  */
  protected $searchable = [
        'columns' => [
            'customers.firstname' => 10,
            'customers.lastname' => 5
        ]
    ];

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
  * The customer city
  */
  public function city()
  {
      return $this->belongsto('App\Models\City');
  }

  /**
  * The next order of serviceType's task
  */
  public function nextCategoryOrder()
  {

    return $this->categories()->max('order') + 1 ;
    
  }

  public function name(){
    return $this->firstname . " " . $this->lastname;
  }

}
