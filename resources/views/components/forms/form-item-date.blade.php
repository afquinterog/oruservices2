<label class="form-control-label" 
			 for="{{ $name }}">
			{{ $title }}
</label>

<input type="text" 
       id="{{ $name }}" 
			 name="{{ $name }}" 
			 class="form-control datepicker"
			 autocomplete="off"
			 data-date-format="yyyy-mm-dd"
			 value="@isset($value) {{ $value }} @endisset" >