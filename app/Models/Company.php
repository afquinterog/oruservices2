<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Database;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{

	use SoftDeletes;

	use Database;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'code', 'name', 'description'
	];

	/**
  * Get company list
  * 
  */
  public static function list(){
    return Company::orderBy('name')->get();
  }

  /**
	* Save or update the model information
	*
	* @param array $data
	*/
	public function saveOrUpdate(array $data)
	{
		return $this->persist( Company::class, $data);
	}

	/**
  * Company reports
  */
  public function reports()
  {
    return $this->belongsToMany('App\Models\Report');
  }

}
