
 {{--
  Autocomplete Usage
  

 	@component('components.forms.form-item-select', [ 'items' => $branches ] )
	  @slot('title') Sucursal @endslot
	  @slot('name') branch @endslot
	@endcomponent 

  --}}

<label class="form-control-label" 
			 for="{{ $name }}">
			{{ $title }}
</label>

<select class="form-control" name='{{ $name }}'>

	@foreach ($items as $item )
     <option value='{{ $item->id }}' 
     	{{ isset($selected) && $item->id == $selected ? "selected='selected'" : "" }}'
     	> 
     	{{ $item->name }} 
     </option>
	@endforeach

</select>