

	@component('components.table')

			
				@slot('columns')
					 <th> {{ "Nombre" }} </th>
	         <th class="text-nowrap">{{ __('messages.actions') }}</th>
				@endslot

				@foreach ( $serviceType->branches as $branch)

	        <tr>
	        	<td>{{ $branch->name }}</td>

	        	<td class="text-nowrap">

							@component('components.table-option')
								@slot('title') {{ __("Subir") }} @endslot
								@slot('route') 
									{{ url( "/branches/{$branch->id}/orderUp/service-type/{$serviceType->id}") }}
								@endslot 
							
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __("Bajar") }} @endslot
								@slot('route')
									{{ url( "/branches/{$branch->id}/orderDown/service-type/{$serviceType->id}") }}
								@endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __('messages.disable') }} @endslot
								@slot('route') {{ url("branches/{$branch->id}/service-type/{$serviceType->id}/delete") }} @endslot
								@slot('icon') wb-close @endslot
							@endcomponent 	

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent


		@include('servicetypes.edit-branches-form')

		


