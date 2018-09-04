
<div class="panel-body container-fluid">

  <div class="div-wrap">

    <h4 class="div-title">{{ __('messages.company_create_title') }}</h4>


      <div class="example">
        <form action="/companies/update/{{$company->id}}" method="POST" >

          {{ method_field('PUT') }}

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $company->id }}">


          <div class="row">
            <div class="form-group col-xs-12 col-md-6">    
              @component('components.forms.form-item-text' )
                @slot('title') {{ __('messages.company_code') }} @endslot
                @slot('name') code @endslot
                @slot('value') {{ $company->code }} @endslot
              @endcomponent
            </div>

            <div class="form-group col-xs-12 col-md-6">    
              @component('components.forms.form-item-text' )
                @slot('title') {{ __('messages.company_name') }} @endslot
                @slot('name') name @endslot
                @slot('value') {{ $company->name }} @endslot
              @endcomponent
            </div>

          </div>

          <div class="row">
             <div class="form-group col-xs-12 col-md-12">

              @component('components.forms.form-item-textarea')
                @slot('title') {{ __('messages.company_description') }} @endslot
                @slot('placeholder')  {{ __('messages.company_description') }} @endslot
                @slot('name') description @endslot
                @slot('rows') 5 @endslot
                @slot('value') {{ $company->description }} @endslot
              @endcomponent
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-12 col-md-4 offset-md-0">

              <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>

            </div>
          </div>

        </form>
      </div>

  </div>
</div>
