
<div class="panel-body container-fluid">

  <div class="div-wrap">

    <h4 class="div-title">{{ __('messages.users_basic_information') }}</h4>


      <div class="example">
        <form action="/modules/users/store" method="POST" >

          {{ method_field('POST') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $user->id }}">
         

          <div class="row">

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Nombre @endslot
                @slot('placeholder') Nombre @endslot
                @slot('name') name @endslot
                @slot('value') {{ $user->name }} @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Correo @endslot
                @slot('placeholder') Correo @endslot
                @slot('name') email @endslot
                @slot('value') {{ $user->email }} @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Contraseña @endslot
                @slot('placeholder') Contraseña @endslot
                @slot('name') password @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-text')
                @slot('title') Repetir Contraseña @endslot
                @slot('placeholder') Contraseña @endslot
                @slot('name') password2 @endslot
              @endcomponent
            </div>
            
          </div>

          <div class="row">

             <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-select', [ 'items' => $roles, 'selected' => $user->roles()->first()->id ] )
                @slot('title') Rol @endslot
                @slot('name') role_id @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-6">
              @component('components.forms.form-item-select', [ 'items' => $companies, 'selected' => $user->company_id ] )
                @slot('title') Compañia @endslot
                @slot('name') company_id @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">



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