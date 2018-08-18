

@if ( $id === App\Models\ServiceStatus::CREATED )
	<span class="tag tag-round tag-default">{{ $slot }}</span>
@endif 

@if ( $id === App\Models\ServiceStatus::ESTIMATED )
	<span class="tag tag-round tag-primary">{{ $slot }}</span>
@endif 

@if ( $id === App\Models\ServiceStatus::CONFIRMED )
	<span class="tag tag-round tag-info">{{ $slot }}</span>
@endif 

@if ( $id === App\Models\ServiceStatus::ASSIGNED )
	<span class="tag tag-round tag-success">{{ $slot }}</span>
@endif 

@if ( $id === App\Models\ServiceStatus::EXECUTED )
	<span class="tag tag-round tag-warning">{{ $slot }}</span>
@endif 

@if ( $id === App\Models\ServiceStatus::BILLED )
	<span class="tag tag-round tag-danger">{{ $slot }}</span>
@endif 

@if ( $id === App\Models\ServiceStatus::PAYED )
	<span class="tag tag-round tag-dark">{{ $slot }}</span>
@endif
