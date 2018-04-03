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

          @component('components.forms.tab-title', [ 'active' => session('tab', 'basic') ] )
            @slot('title') Basicos  @endslot
            @slot('name') basic @endslot
            @slot('default') true @endslot
          @endcomponent  

          @component('components.forms.tab-title', [ 'active' => session('tab') ])
            @slot('title') Atributos @endslot
            @slot('name') attributes @endslot        
          @endcomponent 

          @component('components.forms.tab-title', [ 'active' => session('tab') ])
            @slot('title') Tareas @endslot
            @slot('name') tasks @endslot            
          @endcomponent 

          @component('components.forms.tab-title', [ 'active' => session('tab') ])
            @slot('title') Sucursales @endslot
            @slot('name') branches @endslot            
          @endcomponent  

          @component('components.forms.tab-title', [ 'active' => session('tab') ])
            @slot('title') Asignación @endslot
            @slot('name') assign @endslot            
          @endcomponent  

          @component('components.forms.tab-title', [ 'active' => session('tab') ])
            @slot('title') Estadisticas @endslot
            @slot('name') stats @endslot            
          @endcomponent 

          @component('components.forms.tab-title', [ 'active' => session('tab') ])
            @slot('title') Notificaciones @endslot
            @slot('name') notifications @endslot            
          @endcomponent 


        @endslot 
        

        @slot('tabContent')

          @component('components.forms.tab-item', [ 'active' => session('tab', 'basic') ])
              @slot('name') basic @endslot

              @include('servicetypes.edit-basic')

          @endcomponent

          @component('components.forms.tab-item',  [ 'active' => session('tab') ])
              @slot('name') attributes @endslot
              
              @include('servicetypes.edit-attributes')

          @endcomponent

          @component('components.forms.tab-item', [ 'active' => session('tab') ])
              @slot('name') tasks @endslot
              
              @include('servicetypes.edit-tasks')

          @endcomponent

          @component('components.forms.tab-item', [ 'active' => session('tab') ])
              @slot('name') branches @endslot

              @include('servicetypes.edit-branches')

          @endcomponent

           @component('components.forms.tab-item', [ 'active' => session('tab') ])
           
              @slot('name') assign @endslot
              
              @include('servicetypes.edit-roles')

          @endcomponent

          @component('components.forms.tab-item', [ 'active' => session('tab') ])
              @slot('name') stats @endslot
              this is the data for the stats
          @endcomponent

          @component('components.forms.tab-item', [ 'active' => session('tab') ])
              @slot('name') notifications @endslot
              this is the data for the notifications
          @endcomponent

        @endslot


      @endcomponent

		

		</div>

		

	@endcomponent 



@endsection