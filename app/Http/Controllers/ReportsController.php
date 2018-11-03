<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Auth;

use Facades\App\User;
use Facades\App\Models\Report;
use Facades\App\Models\Customer;
use Facades\App\Models\ReportDownload;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Bouncer;


class ReportsController extends Controller
{
    
  /**
   * Display the reports
   *
   * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $filter = allQueryFormat( $request->filter );

    $reports = Report::list( $filter );
   
    $request->flash();

    return view('reports.index', [ 'reportList' => $reports ] );
    
  }

  /**
   * Display report detail
   * 
   * @param int $id of report
   * @return \Illuminate\Http\Response
  */
  public function view($code)
  { 
    $report = Report::getReport( $code );
    
    return view('reports.report', ['report' => $report ] );
  }

  /**
   * Display user reports
   *
   * @return \Illuminate\Http\Response
  */
  public function reportUser(Request $request)
  { 
    $user = User::find( auth()->user()->id );

    $downloads = ReportDownload::getUserReports( auth()->user()->id );

  	$request->flash();

    return view('reports.reports-user', [ 'downloads' => $downloads ] );
  }

  /**
   * Execute the report
   *
   * @return \Illuminate\Http\Response
  */
  public function execute(Request $request)
  {
    $data = $request->all();

    if( isset($data['param']) ){
      
      $params = Report::validateEmptyParams( $data['param'] );

        if(!$params["status"]){
          
          request()->session()->flash('warning', __('messages.param_missing').$params["param"]);

          return back()->withInput();
        }
     

    }

    Report::execute($data);

    return redirect()->route('reportsUser');
  }


}
