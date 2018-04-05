@extends('layouts.web')


@section('content')

	@component('components.page')
	  @slot('title') {{ __('messages.roles_title') }} @endslot

	  @slot('breadcrumbs')
	  	<ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
	        <li class="breadcrumb-item active"><a href="roles"> {{ __('messages.roles_title') }} </a></li>
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
					 <th> {{ __('messages.roles_column_name') }} </th>
	         <th> {{ __('messages.roles_column_title') }}</th>
	         <th class="text-nowrap">{{ __('messages.actions') }}</th>
				@endslot

				@foreach ($roles as $role)

	        <tr>
	        	<td>{{ $role->name }}</td>
	        	<td>{{ $role->title }}</td>

	        	<td class="text-nowrap">

	        		@component('components.table-option')
								@slot('title') {{ __('messages.edit') }} @endslot
								@slot('route') {{ url('/roles/edit/' . $role->id) }} @endslot
								@slot('icon') wb-wrench @endslot
							@endcomponent

							{{-- @component('components.table-option') --}}
								{{-- @slot('title') {{ __('messages.disable') }} @endslot --}}
								{{-- @slot('route') {{ url('/roles/delete/' . $role->id) }} @endslot --}}
												{{-- @slot('route') {{ route('services-type-delete', ['id' => $serviceType->id ]) }} @endslot --}}
								{{-- @slot('icon') wb-close @endslot --}}
							{{-- @endcomponent 	 --}}

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent

		{{-- </div> --}}

		@component('components.pagination')
			{{ $roles->appends(['filter' => isset($filter) ? $filter : "" ])->links() }}
		@endcomponent


		<div class="site-action" data-plugin="actionBtn">
			<a href="roles/new">
	    <button type="button" class="site-action-toggle btn-raised btn btn-primary btn-floating">
	      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
	      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
	    </button>
	  	</a>
		  
  </div>

	@endcomponent 


@endsection