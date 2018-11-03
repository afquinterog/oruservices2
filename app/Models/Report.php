<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Exports\ReportExport;
use App\Exports\ReportDistanceTravelExport;
use App\Exports\ReportCombustibleConsumptionExport;
use Facades\App\Models\Company;
use Facades\App\User;
use App\Traits\Database;
use Maatwebsite\Excel\Facades\Excel;


class Report extends Model
{

	use SoftDeletes;

  use Database;

  /**
  * The companies
  */
  public function companies()
  {
    return $this->belongsToMany('App\Models\Company');
  }

  /**
  * The report downloads
  */
  public function downloads()
  {
    return $this->hasMany('App\Models\ReportDownload');
  }

  /**
   * Save or update the model information
   *
   * @param array $data 
   */
  public function saveOrUpdate(array $data)
  {
    return $this->persist( Report::class, $data);  
  }

  

  /**
  * Get report list
  * 
  */
  public static function list( $filter = '' )
  { 
    $company = auth()->user()->company;
    
    $reports = $company->reports()
                      ->where( 'company_id', '=', auth()->user()->company->id )
                      ->where(function($query) use ($filter)
                          {
                            $query ->where('name', 'LIKE', $filter )
                            ->orWhere( 'code', 'LIKE', $filter );
                          })->orderBy('code','ASC')->get();

    return $reports;
  }

	/**
  * Get report data
  * 
  */
	public function getReport( $code )
	{
		$report = Report::where('code', '=', $code )->first();

		$this->getParameters($report);

		return $report;
	}

	/**
  * Get report parameters
  * 
  */
	public function getParameters( $report )
	{
		$parameters = preg_match_all('/(?<={)[^}]+(?=})/', $report->sql, $result) ? $result[0] : Array();
		$report->parameters = array_unique($parameters);
	}

	/**
  * Execute the report and put in storage
  * 
  */
	public function execute($data)
	{
		$report = Report::find($data['id']);

		if( isset($data['param'])){
		  $parameters = $data['param'];	
		  $report->setParameters($parameters);
		}

		$reportName = env('REPORTS_PREFIX') . $report->code . "_" . date('m_d_Y_h_i_s', time()) . ".xlsx" ;
    
		if( ! $report->custom ){

      Excel::store(new ReportExport($report), $reportName, 's3');

    }
    else{
      
      Excel::store(new $report->class($report), $reportName, 's3');

    }

    //Save the report link
    $data = ['user_id' => auth()->user()->id , 'status' => 2, 'route' => $reportName ];

    $reportDownload = new \App\Models\ReportDownload($data);

    $report->downloads()->save($reportDownload);

    return $reportName;

	}

	/**
  * Set report parameters
  * 
  */
	public function setParameters($parameters)
	{
		if( ! $this->custom){
			$special = array("{", "}");

			foreach($parameters as $key => $value){
				$this->sql = str_replace( $key, $value, $this->sql);
			}

			$this->sql = str_replace( $special, "", $this->sql);	
		}
		else{
			$this->parameters = $parameters;
		}
		
	}

  /**
  * ValidateParamsEmpty
  * @param Array of params
  * @return Array['status' => boolean , 'param' => param_missing]
  */
  public function validateEmptyParams( Array $parameters )
  {
    foreach ($parameters as $key => $value) {
        
      if($value == null){

        return ['status' => false, 'param' => $key];

      }
    }
    
    return ['status' => true, 'param' => null];

  }

}
