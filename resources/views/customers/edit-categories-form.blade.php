<h4 class="div-title">{{ __('Nueva categoría') }}</h4>

		<div class="example">
        <form action="/customers/store/category" method="POST" >

          {{ method_field('POST') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="customer" value="{{ $customer->id }}">

          <div class="row">

           <div class="form-group col-xs-12 col-md-4">
              @component('components.forms.form-item-text')
                @slot('title') Código @endslot
                @slot('placeholder') Codigo @endslot
                @slot('name') code @endslot
                @slot('value') @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">

           <div class="form-group col-xs-12 col-md-4">
              @component('components.forms.form-item-text')
                @slot('title') Tarea @endslot
                @slot('placeholder') Tarea @endslot
                @slot('name') name @endslot
                @slot('value') @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">

           <div class="form-group col-xs-12 col-md-4">
              @component('components.forms.form-item-text')
                @slot('title') Descripción @endslot
                @slot('placeholder') Descripción @endslot
                @slot('name') description @endslot
                @slot('value') @endslot
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