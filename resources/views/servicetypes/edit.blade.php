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
    
    @component('components.forms.errors') @endcomponent


		<div class="row row-lg">

      @component('components.forms.tabs')

        @slot('tabTitles')

          @component('components.forms.tab-title')
            @slot('title') Basicos @endslot
            @slot('name') basic @endslot
            @slot('active') active @endslot
          @endcomponent  

          @component('components.forms.tab-title')
            @slot('title') Atributos @endslot
            @slot('name') attributes @endslot            
          @endcomponent 

          @component('components.forms.tab-title')
            @slot('title') Tareas @endslot
            @slot('name') tasks @endslot            
          @endcomponent  

          @component('components.forms.tab-title')
            @slot('title') Estadisticas @endslot
            @slot('name') stats @endslot            
          @endcomponent 

          @component('components.forms.tab-title')
            @slot('title') Notificaciones @endslot
            @slot('name') notifications @endslot            
          @endcomponent 


        @endslot 
        

        @slot('tabContent')

          @component('components.forms.tab-item')
              @slot('name') basic @endslot
              @slot('active') active @endslot

                @include('servicetypes.edit-basic')
                
          @endcomponent

          @component('components.forms.tab-item')
              @slot('name') attributes @endslot
              this is the data for the attributes
          @endcomponent

          @component('components.forms.tab-item')
              @slot('name') tasks @endslot
              this is the data for the tasks
          @endcomponent

          @component('components.forms.tab-item')
              @slot('name') stats @endslot
              this is the data for the stats
          @endcomponent

          @component('components.forms.tab-item')
              @slot('name') notifications @endslot
              this is the data for the notifications
          @endcomponent

        @endslot


      @endcomponent

		

		</div>

		

	@endcomponent 


@endsection