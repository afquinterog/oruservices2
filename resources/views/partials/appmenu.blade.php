<div class="site-menubar site-menubar-light">
    {{-- Site menu component --}}
   <div class="site-menubar-body">
      <div>
        <div>
         
          <ul class="site-menu" data-plugin="menu">

            <li class="site-menu-category">Options</li>

            
            @component('components.menu-item-title')
              @slot('title') Dashboard @endslot
              @slot('route') dashboard @endslot
            @endcomponent 


            @component('components.menu-item-title')

              @slot('title') Empresa @endslot
              @slot('route') javascript::void(0) @endslot           

              @component('components.menu-item-title-internal')

                @slot('title') Clientes @endslot
                @slot('route') javascript::void(0) @endslot     

                  @component('components.menu-item')
                    @slot('title') Listado @endslot
                    @slot('route') customers @endslot  
                  @endcomponent

                   @component('components.menu-item')
                    @slot('title') Categorias @endslot
                    @slot('route') categories @endslot  
                  @endcomponent

              @endcomponent

              @component('components.menu-item')
                @slot('title') Sucursales @endslot
                @slot('route') branches @endslot    
              @endcomponent

            @endcomponent


            @component('components.menu-item-title')
              @slot('title') Usuarios @endslot
              @slot('route') javascript::void(0) @endslot           

                @component('components.menu-item')
                  @slot('title') Listado @endslot
                  @slot('route') users @endslot    
                @endcomponent

                @component('components.menu-item')
                  @slot('title') Roles @endslot
                  @slot('route') roles @endslot    
                @endcomponent

            @endcomponent


            @component('components.menu-item-title')
              @slot('title') Servicios @endslot
              @slot('route') javascript::void(0) @endslot           

                @component('components.menu-item')
                  @slot('title') Tipos de servicio @endslot
                  @slot('route') service-types @endslot    
                @endcomponent

                @component('components.menu-item')
                  @slot('title') Atributos @endslot
                  @slot('route') attributes @endslot    
                @endcomponent

            @endcomponent
           
          </ul>

        </div>
      </div>
    </div> 
    {{-- End site menu component --}}  
  </div>