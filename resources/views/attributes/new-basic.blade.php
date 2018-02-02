
<div class="panel-body container-fluid">

  <div class="div-wrap">

    <h4 class="div-title">{{ __('messages.attributes_basic_information') }}</h4>


      <div class="example">
        <form action="/attributes/store/basic" method="POST" >

          {{ method_field('POST') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
         

          <div class="row">

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Nombre @endslot
                @slot('placeholder') Nombre @endslot
                @slot('name') name @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-6">

              @component('components.forms.form-item-text')
                @slot('title') Tipo Atributo (DEBE SER UNA LISTA?????) @endslot
                @slot('placeholder') Tipo de atributo @endslot
                @slot('name') attribute_type @endslot
              @endcomponent
            </div>
          </div>

          <div class="row">

            <div class="form-group col-xs-6 col-md-6">
                
              <label class="form-control-label" >Activo</label>

              @component('components.forms.form-item-radio-item')
                @slot('title') Si @endslot
                @slot('name') active @endslot
                @slot('id') active @endslot
                @slot('value') 1 @endslot
              @endcomponent

              @component('components.forms.form-item-radio-item')
                @slot('title') No @endslot
                @slot('name') active @endslot
                @slot('id') inactive @endslot
                @slot('value') 0 @endslot
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