<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;

class Category extends Model
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
  protected $fillable = ['code', 'name', 'description'];

  /**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    return $this->persist( Category::class, $data);  
  }

  /**
  * Get categories list
  * 
  */
  public static function list(){
    return Category::orderBy('name')->get();
  }

}
