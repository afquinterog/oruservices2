<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeType extends Model
{
   /**
   * The related attributes
   */
  public function attributes()
  {
      return $this->hasMany('App\Models\Attribute');
  }
}
