<h4 class="div-title">{{ __('Nueva notificación') }}</h4>

		<div class="example">
        <form action="/service-types/store/notification" method="POST" >

          {{ method_field('POST') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="service" value="{{ $serviceType->id }}">

          <div class="row">

            <div class="form-group col-xs-12 col-md-12">
              @component('components.forms.form-item-select', [ 'items' => $notificationEvents, 
                                                                'nameProperty' => 'description'  ] )
                @slot('title') Evento @endslot
                @slot('name') notification_event_id @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-select', [ 'items' => $notificationTypes, 'nameProperty' => "type" ] )
                @slot('title') Tipo de notificación @endslot
                @slot('name') notification_type_id @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Destino @endslot
                @slot('placeholder') Destino de la notificación @endslot
                @slot('name') destiny @endslot
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