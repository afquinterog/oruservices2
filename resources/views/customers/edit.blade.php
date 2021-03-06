@extends('layouts.web')


@section('content')

	@component('components.page')
	  @slot('title') {{ __('messages.customers_title') }} @endslot

	  @slot('breadcrumbs')
	  	<ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
	        <li class="breadcrumb-item active"><a href="#"> {{ __('messages.customers_title') }} </a></li>
	      </ol>
	  @endslot


    @component('components.forms.success') @endcomponent
    
    @component('components.forms.errors') @endcomponent


		<div class="row row-lg">

      @component('components.forms.tabs')

        @slot('tabTitles')

          @component('components.forms.tab-title', [ 'active' => session('tab', 'basic') ])
            @slot('title') Clientes @endslot
            @slot('name') basic @endslot        
          @endcomponent 

        @endslot 
        

        @slot('tabContent')

          @component('components.forms.tab-item', [ 'active' => session('tab', 'basic') ])
              @slot('name') basic @endslot
              
              @include('customers.edit-customer')

          @endcomponent

        @endslot


      @endcomponent


		</div>
		

	@endcomponent 


@endsection