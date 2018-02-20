

<label class="form-control-label" 
			 for="{{ $name }}">
			{{ $title }}
</label>
<input type="text" 
			 class="form-control" 
			 id="{{ $name }}" 
			 name="{{ $name }}" 
			 placeholder="@isset($placeholder) {{ $placeholder }} @endisset"  
			 value="@isset($value) {{ $value }} @endisset">