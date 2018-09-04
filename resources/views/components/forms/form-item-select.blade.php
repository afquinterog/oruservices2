
 {{--
  Autocomplete Usage
  

 	@component('components.forms.form-item-select', [ 'items' => $branches, 'selected' => $selectedId, 'nameProperty' => 'description' ] )
	  @slot('title') Sucursal @endslot
	  @slot('name') branch @endslot
	@endcomponent 

  --}}

 	@if (isset($nameProperty))
		@php $nameProperty = $nameProperty; @endphp
	@else
  	@php $nameProperty = "name"; @endphp
	@endif


<label class="form-control-label" 
			 for="{{ $name }}">
			{{ $title }}
</label>

<select class="form-control" name='{{ $name }}'>

	@foreach ($items as $item )
     <option value='{{ $item->id }}' 
     	{{ isset($selected) && $item->id == $selected ? "selected='selected'" : "" }}'
     	> 
     	{{ $item->$nameProperty }} 
     </option>
	@endforeach

</select>