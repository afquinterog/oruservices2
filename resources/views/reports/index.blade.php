@extends('layouts.web')


@section('content')

	@component('components.page')
	  @slot('title') {{ __('messages.reports') }} @endslot

	  @slot('breadcrumbs')
	  	<ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
	        <li class="breadcrumb-item active"><a href="#"> {{ __('messages.reports') }} </a></li>
	      </ol>
	  @endslot

		@component('components.forms.success') @endcomponent

		@component('components.table')

				@slot('filters')
					<form class="form-inline">
				      <div class="form-group">				        				        
				        <label class="sr-only" for="inputInlineUsername">Filtro</label>
					        <input type="text" class="form-control" 
					        id="filter" name="filter" value="{{ old('filter') }}" placeholder="Ingresar código" autocomplete="off">
				      </div>
				      <div class="form-group">
				        <button type="submit" class="btn btn-primary btn-outline">Buscar</button>
				      </div>
				     
			    	</form>
				@endslot

			@slot('columns')
				 <th> {{ __('messages.code') }} </th>	
				 <th> {{ __('messages.companies_name') }} </th>		         
		         <th class="text-nowrap">{{ __('messages.actions') }}</th>
			@endslot

			@foreach ($reportList as $report)
			<tr>
			    <td>{{ $report->code }}</td>
	        	<td>{{ $report->name }}</td>
			    <td class="text-nowrap">
			        @component('components.table-option-button')
						@slot('title') {{ __('messages.edit') }} @endslot
						@slot('route') {{ url('/report/' . $report->code) }} @endslot
						@slot('text') Ejecutar @endslot
					@endcomponent
				</td>
			        	
			</tr>
			@endforeach
						
		@endcomponent

						
		
	@endcomponent


@endsection
