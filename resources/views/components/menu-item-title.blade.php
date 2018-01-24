 <li class="dropdown 
     site-menu-item has-sub">

  <a  data-toggle="dropdown" 
      href="{{ $route }}" 
      data-dropdown-toggle="false">
    <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
    <span class="site-menu-title">{{ $title }}</span>
    <span class="site-menu-arrow"></span>
  </a>

  <div class="dropdown-menu">
    <div class="site-menu-scroll-wrap is-list">
      <div>
        <div>
          <ul class="site-menu-sub site-menu-normal-list">
						{{ $slot }}
					</ul>
        </div>
      </div>
    </div>
  </div>
</li>
