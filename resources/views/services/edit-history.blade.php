@php

 foreach( $service->audits as $change){
	//rint_r($change->old_values);
	$collection1 = collect($change->old_values);
	$collection2 = collect($change->new_values);	

	$oldData = "";
	foreach( $collection1 as $key => $item){
		$oldData .= $key . "=>" . $item;
	}
	$change->oldData = $oldData;

	$newData = "";
	foreach( $collection2 as $key => $item){
		$newData .= $key . "=>" . $item;
	}
	$change->newData = $newData;

	
	$result = $collection2->diffAssoc($collection1);
	$change->differences = $result;

	//print_r($result);
	//echo "<br/>";



	// $string = "" ;
	// foreach( $collection as $key => $value){
	// 	$string .= $key . ":" .$value;
	// }	

	// $change->old_values = $string;

	// $collection = collect($change->new_values);	
	// $string = "" ;
	// foreach( $collection as $key => $value){
	// 	$string .= $key . ":" .$value;
	// }	
	
	// $change->new_values = $string;


	
	//echo $string;

	//echo "<br/>";
 }
 //exit;

@endphp


@component('components.table')

			
				@slot('columns')
					 <th> {{ "Datos anteriores" }} </th>
	         <th> {{ "Datos nuevos" }}</th>
	         <th> {{ "Usuario" }}</th>
				@endslot

				@foreach ( $service->audits as $change)

	        <tr>
	        	<td>{{ $change->oldData }}</td>
	        	<td>{{ $change->newData }}</td>
						<td>{{ $change->user->email }}</td>

		      </tr>

	   		@endforeach
							

		@endcomponent