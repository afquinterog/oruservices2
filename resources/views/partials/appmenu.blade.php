<div class="site-menubar site-menubar-light">
    {{-- Site menu component --}}
   <div class="site-menubar-body">
      <div>
        <div>
         
          <ul class="site-menu" data-plugin="menu">

            <li class="site-menu-category">Options</li>

            @if ( ! App::environment('testing') )

              @include(  "partials.menu-" . auth()->user()->roles()->first()->name  , [])

            @endif
           
          </ul>

        </div>
      </div>
    </div> 
    {{-- End site menu component --}}  
  </div>