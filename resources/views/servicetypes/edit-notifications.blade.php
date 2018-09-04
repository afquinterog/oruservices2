

	@component('components.table')

			
				@slot('columns')
					 <th> {{ "Nombre" }} </th>
					 <th> {{ "Tipo" }} </th>
	         <th> {{ "Destino" }}</th>
	         <th class="text-nowrap">{{ __('messages.actions') }}</th>
				@endslot

				@foreach ( $serviceType->notifications as $item)

	        <tr>
	        	<td>{{ $item->event->description }}</td>
	        	<td>{{ $item->eventType->type }}</td>
	        	<td>{{ $item->destiny }}</td>

	        	<td class="text-nowrap">

							@component('components.table-option')
								@slot('title') {{ __('messages.disable') }} @endslot
								@slot('route') {{ url("notifications/delete/{$item->id}") }} @endslot --}}
								@slot('icon') wb-close @endslot
							@endcomponent 	

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent


		@include('servicetypes.edit-notifications-form')

		


