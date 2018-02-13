

	@component('components.table')

			
				@slot('columns')
					<th> {{ "Nombre" }} </th>
	        <th class="text-nowrap">{{ __('messages.actions') }}</th>
				@endslot

				@foreach ( $serviceType->tasks as $task)

	        <tr>
	        	<td>{{ $task->name }}</td>

	        	<td class="text-nowrap">

	        	
					@component('components.table-option')
						@slot('title') {{ __('messages.disable') }} @endslot
						@slot('route') {{ url('/service-types/delete/' . $serviceType->id) }} @endslot
						{{-- @slot('route') {{ route('services-type-delete', ['id' => $serviceType->id ]) }} @endslot --}}
						@slot('icon') wb-close @endslot
					@endcomponent  

					@component('components.table-option')
						@slot('title') {{ __("Subir") }} @endslot
						@slot('route') 
							{{ url( "/tasks/{$task->id}/orderUp/service-type/{$serviceType->id}") }}
						@endslot 
						@slot('icon') wb-dropup @endslot
					@endcomponent 	

					@component('components.table-option')
						@slot('title') {{ __("Bajar") }} @endslot
						@slot('route')
							{{ url( "/tasks/{$task->id}/orderDown/service-type/{$serviceType->id}") }}
						@endslot
						@slot('icon') wb-dropdown @endslot
					@endcomponent 	

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent


	 @include('servicetypes.edit-tasks-form')

		


