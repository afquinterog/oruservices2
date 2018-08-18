
<div class="panel-body container-fluid">

  <div class="div-wrap">

    <h4 class="div-title">{{ __('messages.customers_basic_information') }}</h4>


      <div class="example">
        <form action="/customers/store" method="POST" >

          {{ method_field('POST') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $customer->id }}">
         
          <div class="row">

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Identificación @endslot
                @slot('placeholder') Identificación @endslot
                @slot('name') code @endslot
                @slot('value') {{ $customer->code }} @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Nombres @endslot
                @slot('placeholder') Nombres @endslot
                @slot('name') firstname @endslot
                @slot('value') {{ $customer->firstname }} @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Apellidos @endslot
                @slot('placeholder') Apellidos @endslot
                @slot('name') lastname @endslot
                @slot('value') {{ $customer->lastname }} @endslot
              @endcomponent
            </div>


            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Correo @endslot
                @slot('placeholder') Correo @endslot
                @slot('name') email @endslot
                @slot('value') {{ $customer->email }} @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Dirección @endslot
                @slot('placeholder') Direccion @endslot
                @slot('name') address @endslot
                @slot('value') {{ $customer->address }} @endslot
              @endcomponent
            </div>

          

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Teléfono @endslot
                @slot('placeholder') Telefono @endslot
                @slot('name') phone @endslot
                @slot('value') {{ $customer->phone }} @endslot
              @endcomponent
            </div>

            </div>

            <div class="row">

              <div class="form-group col-xs-12 col-md-6">

                

                @component('components.forms.form-item-select', [ 'items' => $categories ] )
                  @slot('title') 
                    Categoría 
                    <a href="/categories" target="_blank">
                      <i class="locked icon wb-plus" aria-hidden="true"></i>
                    </a>
                  @endslot
                  @slot('name') category_id @endslot
                  @slot('value') {{ $customer->category_id }} @endslot
                @endcomponent

              </div>

               <div class="form-group col-xs-12 col-md-6">
                @component('components.forms.form-item-date' )
                  @slot('title') Fecha de nacimiento @endslot
                  @slot('name') birthday @endslot
                  @slot('value') {{ $customer->birthday }} @endslot
                @endcomponent
              </div>

            </div>

            {{-- <div class="row">

              <div class="form-group col-xs-12 col-md-12">

                @component('components.forms.form-item-autocomplete', [ ] )

                  @slot('title') Buscar clientes  @endslot                    
                  @slot('name') customer  @endslot          
                  @slot('class') customer-autocomplete  @endslot
                  @slot('placeholder') Seleccione cliente  @endslot
                  @slot('id') customer @endslot
                  @slot('route') /find @endslot
                  @slot('filter') filter @endslot

                  @slot('selectedText') ANDRES FELIPE QUINTERO GARCIA @endslot
                  @slot('selectedId') 1 @endslot

                  @slot('display') data.firstname + ' ' + data.lastname @endslot
                  @slot('suggestion') data.firstname + ' ' +  data.lastname + ' - @' + data.email @endslot  
                @endcomponent 
              </div>

            </div> --}}

            <div class="row">

              <div class="form-group col-xs-12 col-md-12">

                @component('components.forms.form-item-autocomplete', [ ] )

                  @slot('title') Seleccionar ciudad  @endslot                    
                  @slot('name') city_id  @endslot          
                  @slot('class') city-autocomplete  @endslot
                  @slot('placeholder') Seleccione ciudad  @endslot
                  @slot('id') city_id @endslot
                  @slot('route') /cities/search @endslot
                  @slot('filter') filter @endslot

                  @slot('selectedText') {{ $customer->city->name }} @endslot
                  @slot('selectedId') {{ $customer->city->id }} @endslot

                  

                  @slot('display') data.name @endslot
                  @slot('suggestion') data.name + ' ' +  data.departmentName +  ' ' + data.countryName  @endslot  
                @endcomponent 

              </div>

            </div>

          <div class="row">
            <div class="form-group col-xs-12 col-md-4 offset-md-0">

              <button type="submit" class="btn btn-primary">Guardar </button>

            </div>
          </div>

        </form>     
      </div>

  </div>
</div> 