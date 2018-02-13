<div class="tab-pane 
		 @isset($active) {{ $active == $name ? "active" : "" }} @endisset"
		 id="{{ $name }}"
		 role="tabpanel" 
		 aria-expanded="true">

	<div class="customTabContent">
			
				{{ $slot }}
			
		</div>
	
</div>