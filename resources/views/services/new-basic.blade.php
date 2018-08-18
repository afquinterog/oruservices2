
<div class="panel-body container-fluid">

  <div class="div-wrap">

    <form action="/service/store" method="POST">

      {{ method_field('POST') }}
      <input type="hidden" name="service_type_id" value="{{ $serviceType->id}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <h4 class="div-title">{{ __('messages.basic_information') }}</h4>

      <div class="group">
        
          <div class="row">

            <div class="form-group col-xs-12 col-md-4">

              @component('components.forms.form-item-date')
                @slot('title') Fecha @endslot
                @slot('placeholder')  @endslot
                @slot('name') service_date @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-8">

              @component('components.forms.form-item-time')
                @slot('title') Hora @endslot
                @slot('placeholder')  @endslot
                @slot('name') time @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

              @component('components.forms.form-item-autocomplete', [ ] )

                @slot('title') Cliente  @endslot                    
                @slot('name') filter  @endslot          
                @slot('class') customer-autocomplete  @endslot
                @slot('placeholder') Seleccione cliente  @endslot
                @slot('id') customer_id @endslot
                @slot('route') /find @endslot
                @slot('filter') filter @endslot


                @slot('display') data.firstname + ' ' + data.lastname @endslot
                @slot('suggestion') data.firstname + ' ' +  data.lastname + ' - @' + data.email @endslot
                
              @endcomponent 

            {{--   <a href=''>Nuevo</a> --}}
              
            </div>
          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

                @component('components.forms.form-item-select', [ 'items' => $serviceType->branches ] )
                  @slot('title') Sucursal @endslot
                  @slot('name') branch_id @endslot
                @endcomponent 
              
            </div>
          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

                @component('components.forms.form-item-text' )
                  @slot('title') Costo @endslot
                  @slot('name') cost @endslot
                @endcomponent 
              
            </div>
          </div>

         
      </div>

      <h4 class="div-title">{{ __('messages.service_create_attributes_title') }}</h4>

      <div class="group">


        @foreach ($serviceType->attributes as $item)

          <div class="form-group col-xs-12 col-md-12">
            @component('components.services.form-create-attribute', [ 'item' => $item ] )
            @endcomponent
          </div>

        @endforeach


      </div>


      <div class="group">

        <div class="row">
          <div class="form-group col-xs-12 col-md-12 offset-md-0">
            <button type="submit" class="btn btn-primary">Guardar </button>
          </div>
        </div>
      </div>


     </form>   

  </div>
</div> 