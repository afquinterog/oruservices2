
<label class="form-control-label" 
			 for="{{ $name }}">
			{{ $title }}
</label>

<select class="form-control" name='{{ $name }}'>

	@foreach ($items as $item )
     <option value='{{ $item->id }}'> {{ $item->name }}</option>
	@endforeach

</select>