<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Report;


class ReportServices implements FromCollection, WithHeadings, ShouldQueue
{

	use Exportable;

	/**
	 * The actual report
	 */ 
	protected  $report;


  /**
   * Custom report constructor
   *
   * @return void
   */
	function __construct($report) {
       $this->report = $report;
   }

  /**
   * Return report headings
   *
   * @return void
   */   
  public function headings(): array
  {
    return ['id','codigo','costo','calificacion','fecha_servicio','fecha_creacion','estado',
        'cedula cliente', 'nombre cliente', 'apellido cliente', 'correo cliente' , 
        'codigo tipo de servicio', 'descripcion tipo servicio', 'codigo sucursal', 'nombre sucursal' , 
        'datos del servicio'
      ];
  }

  /**
   * Return report data as collection
   *
   * @return void
   */
  public function collection()
  {

  	$selectedData = "services.id, services.code, cost, rating, service_date, services.created_at, state,  
      customers.code,
      customers.firstname,
      customers.lastname,
      customers.email,
      service_types.code,
      service_types.name,
      branches.code,
      branches.name,
      custom
             ";

  	$results = DB::table( "services" )
      ->join('customers', 'services.customer_id', '=', 'customers.id')
      ->join('service_types', 'services.service_type_id', '=', 'service_types.id')
      ->join('branches', 'services.branch_id', '=', 'branches.id')
      ->selectRaw( $selectedData )
      ->get();

    $data = collect($results);

    foreach( $data as $item){

      //$item->customData = "My custom data: " . $item->id  ;
      
    }

    return $data;
  }
}