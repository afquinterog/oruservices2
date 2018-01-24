<div class="page-header">
  <h1 class="page-title">{{ $title }}</h1>
  <div class="page-header-actions">

    @if ( isset($breadcrumbs) )
      {{ $breadcrumbs }}

      {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
        <li class="breadcrumb-item active">Basic</li>
      </ol> --}}

    @endif

  </div>
</div>


		<div class="page-content">

			<div class="panel">
				<div class="panel-body container-fluid">

          {{ $slot }}

      </div>
  </div>
</div>
