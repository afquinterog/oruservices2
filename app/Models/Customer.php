<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;
use Illuminate\Support\Facades\DB;

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
   * The attributes that aren't mass assignable.
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
  * The customer category
  */
  public function category()
  {
      return $this->belongsto('App\Models\Category')->withDefault();;
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

  public function servicesCount()
  {
    return DB::table('services')->where('customer_id', $this->id)->count();
  }

  public function name(){
    return $this->firstname . " " . $this->lastname;
  }

}
