@extends('layouts.web')


@section('content')

	@component('components.page')
	  @slot('title') {{ __('messages.myReports') }} @endslot

	  @slot('breadcrumbs')
	  	<ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
	        <li class="breadcrumb-item active"><a href="#"> {{ __('messages.reports') }} </a></li>
	      </ol>
	  @endslot

		@component('components.forms.success') @endcomponent

		@component('components.table')

			@slot('columns')
				 <th> {{ __('messages.code') }} </th>	
				 <th> {{ __('messages.companies_name') }} </th>		         
				 <th> {{ __('messages.status') }} </th>
				 <th> {{ __('messages.ReportDate') }} </th>		         
		         <th class="text-nowrap">{{ __('messages.actions') }}</th>
			@endslot

			@foreach ($downloads as $download)
			<tr>
			    <td>{{ $download->report->code }}</td>
	        <td>{{ $download->report->name }}</td>
        	<td>
        	@if ( $download->status)
						<i class="icon wb-check-mini" aria-hidden="true"></i>
					@else
						<i class="icon wb-close-mini" aria-hidden="true"></i>
					@endif
        	</td>
	        <td>{{ $download->created_at }}</td>
			    <td class="text-nowrap">
			    	@if ( $download->status && Storage::disk('s3')->exists( $download->route) ) 
		        	@component('components.table-option-button')
								@slot('title') {{ __('messages.edit') }} @endslot
								@slot('route') {{ Storage::disk('s3')->temporaryUrl($download->route, now()->addMinutes(10)) }} @endslot
								
								@slot('text') Descargar @endslot
							@endcomponent
						@endif
					</td>
			        	
			</tr>
			@endforeach
						
		@endcomponent

		@component('components.pagination')
			{{ $downloads->appends(['filter' => isset($filter) ? $filter : "" ])->links() }}
		@endcomponent

		{{-- </div> --}}

		
				
		
	@endcomponent


@endsection
