

	@component('components.table')

			
				@slot('columns')
					 <th> {{ "Nombre" }} </th>
	         <th> {{ "Tipo" }}</th>
	         <th class="text-nowrap">{{ __('messages.actions') }}</th>
				@endslot

				@foreach ( $serviceType->attributes as $attr)

	        <tr>
	        	<td>{{ $attr->name }}</td>
	        	<td>{{ $attr->attributeType->name }}</td>

	        	<td class="text-nowrap">

							@component('components.table-option')
								@slot('title') {{ __("Subir") }} @endslot
								@slot('route') 
									{{ url( "/attributes/{$attr->id}/orderUp/service-type/{$serviceType->id}") }}
								@endslot 
								@slot('icon') wb-dropup @endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __("Bajar") }} @endslot
								@slot('route')
									{{ url( "/attributes/{$attr->id}/orderDown/service-type/{$serviceType->id}") }}
								@endslot
								@slot('icon') wb-dropdown @endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __('messages.disable') }} @endslot
								@slot('route') {{ url("attributes/{$attr->id}/service-type/{$serviceType->id}/delete") }} @endslot
								@slot('icon') wb-close @endslot
							@endcomponent 	

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent


		@include('servicetypes.edit-attributes-form')

		


