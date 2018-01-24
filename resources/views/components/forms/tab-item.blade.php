<div class="tab-pane 
		 @isset($active) {{ $active }} @endisset" 
		 id="{{ $name }}" 
		 role="tabpanel" 
		 aria-expanded="true">
	{{ $slot }}
</div>