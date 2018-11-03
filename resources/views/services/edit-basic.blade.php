
<div class="panel-body container-fluid">

  <div class="div-wrap">

    <form action="/services/{{$service->id}}" method="POST">

       @method('PUT')


      <input type="hidden" name="id" value="{{ $service->id}}">
      <input type="hidden" name="service_type_id" value="{{ $service->service_type_id}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <h4 class="div-title">{{ __('messages.basic_information') }}</h4>

      <div class="group">
        
          <div class="row">

            <div class="form-group col-xs-12 col-md-4">

              @component('components.forms.form-item-date')
                @slot('title') Fecha @endslot
                @slot('placeholder')  @endslot
                @slot('name') service_date @endslot
                @slot('value') {{ $service->getDate() }} @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-8">

              @component('components.forms.form-item-time')
                @slot('title') Hora @endslot
                @slot('placeholder')  @endslot
                @slot('name') time @endslot
                @slot('value')  {{ $service->getTime() }} @endslot
              @endcomponent
            </div>

          </div>

          <div class="row" id="customerShow">
             <div class="form-group col-xs-12 col-md-12">

              <label class="form-control-label" for="customer">Cliente</label>
              <label class="form-control-label" for="customer"><b>{{ $service->customer->name()}}</b></label>

              <button onclick="showCustomer();" type="button" class="btn btn-primary">Cambiar cliente</button>
              
            </div>
          </div>

          <div id="customerForm" class="row" style="display:none">
            <div class="form-group col-xs-12 col-md-12">


              @component('components.forms.form-item-autocomplete', [ ] )

                @slot('title') Cliente  @endslot                    
                @slot('name') filter  @endslot          
                @slot('class') customer-autocomplete  @endslot
                @slot('placeholder') Seleccione cliente  @endslot
                @slot('id') customer_id @endslot
                @slot('route') /find @endslot
                @slot('filter') filter @endslot
                @slot('selectedId') {{ $service->customer_id }} @endslot


                @slot('display') data.firstname + ' ' + data.lastname @endslot
                @slot('suggestion') data.firstname + ' ' +  data.lastname + ' - @' + data.email @endslot
                
              @endcomponent 

            {{--   <a href=''>Nuevo</a> --}}
              
            </div>
          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

                @component('components.forms.form-item-select', 
                           [ 'items' => $service->serviceType->branches, 
                             'selected' => $service->branch_id
                           ] )
                  @slot('title') Sucursal @endslot
                  @slot('name') branch_id @endslot
                  
                @endcomponent 
              
            </div>
          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

                <label  class="form-control-label"  for="service_status"> 
                        Estado
                </label>

                <input type="text" 
                     class="form-control"
                     name="" 
                     readonly
                     value="{{ $service->status->description}}" />
                            
            </div>
          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

                <label class="form-control-label" 
                       for="">
                      {{ "Cambiar estado" }}
                </label>

                <select class="form-control" name="transition">
                  <option value=''> 
                    Seleccionar nuevo estado
                  </option>
                  @foreach ($service->transitions as $item )
                     <option value='{{ $item->getName() }}'> 
                      {{ $item->description }} 
                     </option>
                  @endforeach

                </select>
              
            </div>
          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

                @component('components.forms.form-item-text' )
                  @slot('title') Costo @endslot
                  @slot('name') cost @endslot
                  @slot('value') {{ $service->cost }} @endslot
                @endcomponent 
              
            </div>
          </div>

         
      </div>

      <h4 class="div-title">{{ __('messages.service_create_attributes_title') }}</h4>

      <div class="group">


        @foreach ($service->customAttributes as $item)

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


<script type="text/javascript">
  
  function showCustomer(status){
    console.log('show customer');

    $('#customerForm').css("display", "block");
    $('#customerShow').css("display", "none");

    // if( status ){
    //   $('editCustomer').css("display", "visible");
    // }
    // else{
    //   $('editCustomer').css("display", "hidden"); 
    // }
  }

</script>