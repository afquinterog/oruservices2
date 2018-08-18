 <li class="site-menu-category">{{ $title }}</li>
 <li class="dropdown 
     site-menu-item @isset($hasChilds) {{ $hasChilds }} @endisset ">

  <a  data-toggle="dropdown" 
      href="{{ $route }}" 
      data-dropdown-toggle="false"
      aria-expanded="false"
      >
    <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
    <span class="site-menu-title">{{ $title }}</span>
    <span class="site-menu-arrow"></span>
  </a>

  @isset($hasChilds)

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
  @endisset


         