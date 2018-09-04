@extends('layouts.web')


@section('content')

<div class="page-content container-fluid">

	<div class='row'>
		<div class="col-xxl-4 col-lg-6 col-xs-12">
          <!-- Example Tabs In The Panel -->
          <div class="panel nav-tabs-horizontal" data-plugin="tabs">
            <div class="panel-heading">
              <h3 class="panel-title">Opciones comunes</h3>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">

              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#registerService" aria-controls="exampleTopHome" role="tab" aria-expanded="true">
                	{{-- <i class="icon wb-plugin" aria-hidden="true"></i> --}}
                Registrar servicio</a>
              </li>


            </ul>
            <div class="panel-body">
              <div class="tab-content">

                <div class="tab-pane active" id="registerService" role="tabpanel">
                 
									<form action="/service/create" method="POST" >

						          {{ method_field('POST') }}
						          <input type="hidden" name="_token" value="{{ csrf_token() }}">

						          <div class="row">

						           <div class="form-group col-xs-12 col-md-12">
						           
					                @component('components.forms.form-item-select', [ 'items' => $serviceTypes ] )
					                  @slot('title') Tipos de servicios @endslot
					                  @slot('name') service_type_id @endslot
					                  @slot('value')  @endslot
					                @endcomponent

						            </div>

						          </div>

						        <div class="row">
						          <div class="form-group col-xs-12 col-md-4 offset-md-0">

						            <button type="submit" class="btn btn-primary date-picker">Registrar </button>

						          </div>
						        </div>

						      </form>

                </div>

               
              </div>
            </div>
          </div>
          <!-- End Example Tabs In The Panel -->
        </div>
	</div>
</div>



@endsection

