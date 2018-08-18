 <li class="site-menu-item @isset($hasChilds) {{ $hasChilds }} @endisset">

  <a class="animsition-link" href="{{ $route }}">
    <span class="site-menu-title">{{ $title }}</span>
    
  </a>

  @isset($hasChilds)
  	<ul class="site-menu-sub">
			{{ $slot }}
		</ul>
	@endisset
       
</li>

