@extends('layouts.web')


@section('content')

	@component('components.page')
	  @slot('title') {{ __('messages.service_types_title') }} @endslot

	  @slot('breadcrumbs')
	  	<ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
	        <li class="breadcrumb-item active"><a href="#"> {{ __('messages.service_types_title') }} </a></li>
	      </ol>
	  @endslot

	  @component('components.forms.success') @endcomponent


		@component('components.table')

				@slot('filters')
					<form class="form-inline">
			      <div class="form-group">
			        <label class="sr-only" for="inputInlineUsername">Filtro</label>
			        <input type="text" class="form-control" 
			        id="filter" name="filter" value="{{ old('filter') }}" placeholder="Filtro" autocomplete="off">
			      </div>
			     
			      <div class="form-group">
			        <button type="submit" class="btn btn-primary btn-outline">Buscar</button>
			      </div>
			    </form>
				@endslot

				@slot('columns')
					 <th> {{ __('Id') }} </th>
	         <th> {{ __('Fecha') }}</th>
	         <th> {{ __('Tipo') }}</th>
	         <th> {{ __('Cliente') }}</th>
	         <th> {{ __('Sucursal') }}</th>
	         <th> {{ __('Estado') }}</th>
	         <th class="text-nowrap">{{ __('messages.actions') }}</th>
				@endslot

				@foreach ($services as $item)

	        <tr>
	        	<td>{{ $item->id }}</td>
	        	<td>{{ $item->service_date }}</td>
	        	<td>{{ $item->serviceType->name }}</td>
	        	<td>{{ $item->customer->name() }}</td>
	        	<td>{{ $item->branch->name }}</td>
	        	<td>  
	        			@component('components.services.status',  [ 'id' => $item->status->id ])
	        				{{$item->status->description}}
	        		  @endcomponent  
	        	</td>

	        	<td class="text-nowrap">

	        		@component('components.table-option')
								@slot('title') {{ __('messages.edit') }} @endslot
								@slot('route') {{ url('/services/edit/' . $item->id) }} @endslot
								@slot('icon') wb-wrench @endslot
							@endcomponent

							@component('components.table-option')
								@slot('title') {{ __('messages.disable') }} @endslot
								@slot('route') {{ url('/service-types/delete/' . $item->id) }} @endslot
								{{-- @slot('route') {{ route('services-type-delete', ['id' => $serviceType->id ]) }} @endslot --}}
								@slot('icon') wb-close @endslot
							@endcomponent 	

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent

		{{-- </div> --}}

		@component('components.pagination')
			{{ $services->appends(['filter' => old('filter') ])->links() }}
		@endcomponent


		<div class="site-action" data-plugin="actionBtn">
			<a href="services/new">
	    <button type="button" class="site-action-toggle btn-raised btn btn-primary btn-floating">
	      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
	      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
	    </button>
	  	</a>
		  
  </div>

	@endcomponent 


@endsection