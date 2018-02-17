 <li class="site-menu-item has-sub">

  <a  data-toggle="dropdown" 
      href="{{ $route }}" 
      data-dropdown-toggle="false">
    <span class="site-menu-title">{{ $title }}</span>
    <span class="site-menu-arrow"></span>
  </a>

  
  <ul class="site-menu-sub">
		{{ $slot }}
	</ul>
       
</li>
