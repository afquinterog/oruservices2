

	@component('components.table')

			
				@slot('columns')
					 <th> {{ "Nombre" }} </th>
	         <th class="text-nowrap">{{ __('messages.actions') }}</th>
				@endslot

				@foreach ( $branch->serviceTypes as $stype)

	        <tr>
	        	<td>{{ $stype->name }}</td>

	        	<td class="text-nowrap">

							@component('components.table-option')
								@slot('title') {{ __("Subir") }} @endslot
								@slot('route') 
									{{ url( "/service-types/{$stype->id}/orderUp/branch/{$branch->id}") }}
								@endslot 
								@slot('icon') wb-dropup @endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __("Bajar") }} @endslot
								@slot('route')
									{{ url( "/service-types/{$stype->id}/orderDown/branch/{$branch->id}") }}
								@endslot
								@slot('icon') wb-dropdown @endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __('messages.disable') }} @endslot
								@slot('route') {{ url("service-types/{$stype->id}/branch/{$branch->id}/delete") }} @endslot
								@slot('icon') wb-close @endslot
							@endcomponent 	

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent


		{{-- @include('servicetypes.edit-branches-form') --}}

		


