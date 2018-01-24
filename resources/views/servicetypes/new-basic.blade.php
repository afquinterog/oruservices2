
<div class="panel-body container-fluid">

  <div class="div-wrap">

    <h4 class="div-title">{{ __('messages.service_types_basic_information') }}</h4>


      <div class="example">
        <form action="/service-types/store/basic" method="POST" >

          {{ method_field('POST') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
         

          <div class="row">

            <div class="form-group col-xs-12 col-md-4">
              @component('components.forms.form-item-text')
                @slot('title') Codigo @endslot
                @slot('placeholder') Codigo @endslot
                @slot('name') code @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-8">
              @component('components.forms.form-item-text')
                @slot('title') Nombre @endslot
                @slot('placeholder') Nombre @endslot
                @slot('name') name @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

              @component('components.forms.form-item-textarea')
                @slot('title') Descripcion @endslot
                @slot('placeholder') Descripcion del tipo de servicio @endslot
                @slot('name') description @endslot
                @slot('rows') 5 @endslot
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