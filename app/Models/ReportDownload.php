<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportDownload extends Model
{
	/**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
  * The report
  */
  public function report()
  {
    return $this->belongsTo('App\Models\Report');
  }

  /**
   * Get user reports
   */
  public function getUserReports($filter='')
  {
      //Carbon::setLocale('es');

      $reports = ReportDownload::where('user_id', '=', auth()->user()->id )
     							->orderBy('created_at', 'desc');

      return $reports->paginate(10);
  }

}
