

@php
  $item->htmlName = "attr_" . $item->name;
  $value = $item->value ?? "";
@endphp

@if ( $item->attribute_type_id === App\Models\Attribute::TYPE_TEXT )

	@component('components.forms.form-item-text')
	  @slot('title') {{ $item->name }} @endslot
	  @slot('placeholder') {{ $item->name }} @endslot
	  @slot('name') {{ "data[" . $item->code . "]" }} @endslot
	  @slot('value') {{ $value }}  @endslot
	@endcomponent

@endif 

@if ( $item->attribute_type_id === App\Models\Attribute::TYPE_NUMBER )

	@component('components.forms.form-item-text')
	  @slot('title') {{ $item->name }} @endslot
	  @slot('placeholder') {{ $item->name }} @endslot
	  @slot('name') "data[" . $item->code . "]" }} @endslot
	  @slot('value') {{ $value }}  @endslot
	@endcomponent

@endif 

@if ( $item->attribute_type_id === App\Models\Attribute::TYPE_VALUE )

	@component('components.forms.form-item-text')
	  @slot('title') {{ $item->name }} @endslot
	  @slot('placeholder') {{ $item->name }} @endslot
	  @slot('name') {{ "data[" . $item->code . "]" }} @endslot
	  @slot('value') {{ $value }}  @endslot
	@endcomponent

@endif 

@if ( $item->attribute_type_id === App\Models\Attribute::TYPE_DATE )

	@component('components.forms.form-item-date')
    @slot('title') {{ $item->name }} @endslot
    @slot('placeholder') {{ $item->name }}  @endslot
    @slot('name') {{ "data[" . $item->code . "]" }} @endslot
    @slot('value') {{ $value }}  @endslot
  @endcomponent

@endif 

@if ( $item->attribute_type_id === App\Models\Attribute::TYPE_HOUR )

  @component('components.forms.form-item-time')
    @slot('title') {{ $item->name }} @endslot
    @slot('placeholder')  @endslot
    @slot('name') {{ $item->htmlName }} @endslot
     @slot('value') {{ $value }}  @endslot
  @endcomponent

@endif 

@if ( $item->attribute_type_id === App\Models\Attribute::TYPE_LIST )

	@component('components.forms.form-item-date')
    @slot('title') {{ $item->name }} @endslot
    @slot('placeholder') {{ $item->name }}  @endslot
     @slot('name') {{ $item->htmlName }} @endslot
      @slot('value') {{ $value }}  @endslot
  @endcomponent

@endif 


@if ( $item->attribute_type_id === App\Models\Attribute::TYPE_AUTOCOMPLETE )

	@component('components.forms.form-item-autocomplete', [ ] )

    @slot('title') {{ $item->name }}  @endslot                    
    @slot('name') {{ $item->htmlName }} @endslot        
    @slot('class') {{ $item->name }}-autocomplete  @endslot
    @slot('placeholder') Seleccione cliente  @endslot
    @slot('id') {{ $item->name }} @endslot
    @slot('route') /find @endslot
    @slot('filter') filter @endslot


    @slot('display') data.firstname + ' ' + data.lastname @endslot
    @slot('suggestion') data.firstname + ' ' +  data.lastname + ' - @' + data.email @endslot
    
  @endcomponent 

@endif 

