<h4 class="div-title">{{ __('Nuevo atributo') }}</h4>

		<div class="example">
        <form action="/service-types/store/attribute" method="POST" >

          {{ method_field('POST') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="service" value="{{ $serviceType->id }}">

          <div class="row">

            <div class="form-group col-xs-12 col-md-8">
              @component('components.forms.form-item-select', [ 'items' => $attributes ] )
                @slot('title') Atributo @endslot
                @slot('name') attribute @endslot
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