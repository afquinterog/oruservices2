@component('components.menu-item-title')
  @slot('title') Dashboard @endslot
  @slot('route') /dashboard @endslot
@endcomponent 


@component('components.menu-item-title', ['hasChilds' => 'has-sub'])

  @slot('title') Empresa @endslot
  @slot('route') javascript::void(0) @endslot           

  @component('components.menu-item-title-internal')

    @slot('title') Clientes @endslot
    @slot('route') /customers @endslot    

  @endcomponent

  @component('components.menu-item-title-internal')

    @slot('title') Categorías Clientes @endslot
    @slot('route') /categories @endslot    

  @endcomponent

  @component('components.menu-item-title-internal')
    @slot('title') Sucursales @endslot
    @slot('route') /branches @endslot    
  @endcomponent

@endcomponent


@component('components.menu-item-title',  ['hasChilds' => 'has-sub'])
  @slot('title') Usuarios @endslot
  @slot('route') javascript::void(0) @endslot           

    @component('components.menu-item-title-internal')
      @slot('title') Listado @endslot
      @slot('route') /users @endslot    
    @endcomponent

    @component('components.menu-item-title-internal')
      @slot('title') Roles @endslot
      @slot('route') /roles @endslot    
    @endcomponent

@endcomponent


@component('components.menu-item-title',  ['hasChilds' => 'has-sub'])
  @slot('title') Servicios @endslot
  @slot('route') javascript::void(0) @endslot           

    @component('components.menu-item-title-internal')
      @slot('title') Tipos de servicio @endslot
      @slot('route') /service-types @endslot    
    @endcomponent

    @component('components.menu-item-title-internal')
      @slot('title') Atributos @endslot
      @slot('route') /attributes @endslot    
    @endcomponent

     @component('components.menu-item-title-internal')
      @slot('title') Listado @endslot
      @slot('route') /services @endslot    
    @endcomponent

@endcomponent

@component('components.menu-item-title', ['hasChilds' => 'has-sub'])
  @slot('title') Reportes @endslot
  @slot('route') javascript::void(0) @endslot

  @component('components.menu-item')
    @slot('title') Listado @endslot
    @slot('route') reports @endslot
  @endcomponent

  @component('components.menu-item')
    @slot('title') Mis Reportes @endslot
    @slot('route') reports-user @endslot
  @endcomponent

@endcomponent