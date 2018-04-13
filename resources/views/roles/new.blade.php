@extends('layouts.web')


@section('content')

	@component('components.page')
	  @slot('title') {{ __('messages.roles_title') }} @endslot

	  @slot('breadcrumbs')
	  	<ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
	        <li class="breadcrumb-item active"><a href="/roles"> {{ __('messages.roles_title') }} </a></li>
	      </ol>
	  @endslot


   

    @component('components.forms.success') @endcomponent
    
    @component('components.forms.errors') @endcomponent


		<div class="row row-lg">

      @component('components.forms.tabs')

        @slot('tabTitles')

          @component('components.forms.tab-title', [ 'active' => session('tab', 'basic') ])
            @slot('title') Basicos @endslot
            @slot('name') basic @endslot
            
          @endcomponent

        @endslot 
        

        @slot('tabContent')

          @component('components.forms.tab-item', [ 'active' => session('tab', 'basic') ])
              @slot('name') basic @endslot
              
              @include('roles.new-basic')
               
          @endcomponent

        @endslot


      @endcomponent
		

		</div>		

	@endcomponent 


@endsection