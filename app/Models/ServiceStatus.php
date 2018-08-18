<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Database;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceStatus extends Model
{

	const CREATED   = 1;
	const ESTIMATED = 2;
	const CONFIRMED = 3;
	const ASSIGNED  = 4;
	const EXECUTED  = 5;
	const BILLED    = 6;
	const PAYED     = 7;


	use Database;
	use SoftDeletes;
}
