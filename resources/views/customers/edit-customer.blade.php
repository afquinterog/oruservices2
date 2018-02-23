
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
                  @slot('title') Categoría @endslot
                  @slot('name') category_id @endslot
                  @slot('value') {{ $customer->category_id }} @endslot
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