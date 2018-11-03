@extends('layouts.web')


@section('content')

	@component('components.page')
	  @slot('title') {{ __('Calendario') }} @endslot

	  @slot('breadcrumbs')
	  	<ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
	        <li class="breadcrumb-item active"><a href="#"> {{ __('Calendario') }} </a></li>
	      </ol>
	  @endslot

	  @component('components.forms.success') @endcomponent



			<div class="row">
	      <div class="col-xs-12 col-lg-3" style="margin-top:60px">
	        
	        	<form id="serviceForm" action="/calendar" method="GET" >
	        		<input type="hidden" id="actualServiceType" name="actualServiceType" value="{{ $actualServiceType ?? "" }}">

		        	<h4>Fechas</h4>

			        	@component('components.forms.form-item-date')
		              @slot('title') Fecha inicial @endslot
		              @slot('placeholder')  @endslot
		              @slot('name') date @endslot
		              @slot('value'){{ $startDate->toDateString() }}  @endslot
		            @endcomponent

		        	<h4>Tipos de servicio</h4>

		        	<ul class="list-group list-group-bordered">
		        		@foreach ($serviceTypes as $serviceType)
									<li class="list-group-item @if ($actualServiceType == $serviceType->id) active @endif">
										<a href="javascript:void(0)" onclick="changeServiceType({{ $serviceType->id }})"> {{ $serviceType->name }}</a>
									</li>		        			
		        		@endforeach

	            </ul>

	            {{-- <h4>Recursos</h4>

		        	<ul class="list-group list-group-bordered">
	              <li class="list-group-item active">Cancha 1</li>
	              <li class="list-group-item">Cancha 2</li>
	              <li class="list-group-item">Cancha 3</li>
	            </ul> --}}

	            <div class="row">
	            	<div class="form-group col-xs-12 col-md-4 offset-md-0">
	              	<button type="submit" class="btn btn-primary">Actualizar </button>
	            	</div>
	          	</div>

	          </form>

            


	      </div>
	      <div class="col-xs-12 col-lg-9">
	        <div id="calendar"></div>
	      </div>
	    </div>

		
			


		<div class="site-action" data-plugin="actionBtn">
			<a href="categories/new">
	    <button type="button" class="site-action-toggle btn-raised btn btn-primary btn-floating">
	      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
	      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
	    </button>
	  	</a>
		  
  </div>

	@endcomponent 

	<script type="text/javascript">

	function changeServiceType(serviceType){
		$('#actualServiceType').val( serviceType );
		document.getElementById("serviceForm").submit();
	}

	$( document ).ready(function() {

	  // page is now ready, initialize the calendar...
	  $('#calendar').fullCalendar({
	    defaultView: 'agendaWeek',
	    defaultDate: '<?php echo $startDate->toDateString() ?>' ,
	    //efaultView: 'agendaDay',
	    nowIndicator: true,
	    groupByResource: true,

	    defaultTimedEventDuration: '01:00:00',

	    minTime: "06:00:00",

	    header: {
	      left: null,
	      center: '',
	      right: ''
	    },

	    eventRender: function(eventObj, $el) {
	      $el.popover({
	        title: eventObj.title,
	        content: eventObj.description,
	        trigger: 'hover',
	        placement: 'top',
	        container: 'body',
	        html:true
      	});
    	},

	    events: [

	    	<?php echo $services; ?>
		    // {
		    //   title  : 'Andres Felipe Quintero',
		    //   url: "http://localhost/services/edit/15",
		    //   start  : '2018-09-24T12:00:00',
		    //   end    : '2018-09-24T13:00:00',
		    //   backgroundColor: "#F96898",
		    // },
		    // {
		    //   title  : 'Juan David Gonzales Taborda',
		    //   start  : '2018-09-24T14:00:00',
		    //   end    : '2018-09-24T15:00:00'
		    // },
		    // {
		    //   title  : 'event3',
		    //   start  : '2018-09-24T18:30:00',
		    //   allDay : false, // will make the time show
		    // }
	  	]

	  })

});
</script>

@endsection

