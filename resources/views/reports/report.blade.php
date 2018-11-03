@extends('layouts.web')


@section('content')

	@component('components.page')
	  @slot('title') {{ $report->name }} @endslot

	  @slot('breadcrumbs')
	  	<ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
	        <li class="breadcrumb-item active"><a href="#"> {{ __('messages.reports') }} </a></li>
	      </ol>
	  @endslot

		@component('components.forms.success') @endcomponent
		@component('components.forms.warning') @endcomponent

<div class="panel-body container-fluid">

  <div class="div-wrap">
    <div class="example">
        <form action="/report/execute" method="POST" >
         
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $report->id }}">

          @foreach( $report->parameters as $parameter )
          		

          		@if( preg_match('/FECHA/',$parameter) )
          			<div class="row">
		        		<div class="form-group col-xs-12 col-md-6 offset-md-0">
				        	@component('components.forms.form-item-date')
				        		@slot('title') {{ $parameter }} @endslot
				        		@slot('name')  {{  "param[" . $parameter . "]" }} @endslot	        		
				        	@endcomponent
						</div>
					</div>
          		@else
          			<div class="row">
		        		<div class="form-group col-xs-12 col-md-6 offset-md-0">
				        	@component('components.forms.form-item-text')
				        		@slot('title') {{ $parameter }} @endslot
				        		@slot('name')  {{  "param[" . $parameter . "]" }} @endslot	        		
				        	@endcomponent
						</div>
					</div>
          		@endif

          	

          @endforeach
			
			<div class="row">
            <div class="form-group col-xs-12 col-md-4 offset-md-0">

              <button type="submit" class="btn btn-primary"> Ejecutar </button>

            </div>
          </div>

		</form>
	</div>
  </div>
</div>




	@endcomponent


@endsection
