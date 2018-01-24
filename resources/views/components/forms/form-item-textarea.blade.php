
<label class="form-control-label" 
			 for="{{ $name }}">
			{{ $title }}
</label>
<textarea name="{{ $name }}"" 
          rows="@isset($rows) {{ $rows }} @endisset"
          placeholder="@isset($placeholder) {{ $placeholder }} @endisset"
					class="form-control">@isset($value) {{ $value }} @endisset</textarea>