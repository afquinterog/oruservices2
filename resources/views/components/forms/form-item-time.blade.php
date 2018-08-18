<label class="form-control-label" 
			 for="{{ $name }}">
			{{ $title }}
</label>
<input type="text" 
			 class="form-control timepicker" 
			 id="{{ $name }}" 
			 name="{{ $name }}" 
			 autocomplete="off"
			 value="@isset($value) {{ $value }} @endisset">