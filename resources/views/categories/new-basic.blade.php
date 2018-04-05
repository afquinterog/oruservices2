
<div class="panel-body container-fluid">

  <div class="div-wrap">

    <h4 class="div-title">{{ __('messages.categories_basic_information') }}</h4>


      <div class="example">
        <form action="/categories/store" method="POST" >

          {{ method_field('POST') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
         

          <div class="row">

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')

                @slot('title') Código @endslot
                @slot('placeholder') Código @endslot
                @slot('name') code @endslot

              @endcomponent
            </div>

          </div>

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
                @slot('title') Descripción @endslot
                @slot('placeholder') Descripción @endslot
                @slot('name') description @endslot
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