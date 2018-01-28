

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
								@slot('title') {{ __('messages.edit') }} @endslot
								@slot('route') {{ url('/service-types/edit/' . $serviceType->id) }} @endslot
								@slot('icon') wb-wrench @endslot
							@endcomponent

							@component('components.table-option')
								@slot('title') {{ __('messages.disable') }} @endslot
								@slot('route') {{ url('/service-types/delete/' . $serviceType->id) }} @endslot
								{{-- @slot('route') {{ route('services-type-delete', ['id' => $serviceType->id ]) }} @endslot --}}
								@slot('icon') wb-close @endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __("Subir") }} @endslot
								@slot('route') 
									{{ url( "/attributes/{$attr->id}/orderUp/service-type/{$serviceType->id}") }}
								@endslot
								attributes/{attribute}/orderUp/service-type/{serviceType}
								@slot('icon') wb-dropup @endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __("Bajar") }} @endslot
								@slot('route')
									{{ url( "/attributes/{$attr->id}/orderDown/service-type/{$serviceType->id}") }}
								@endslot
								@slot('icon') wb-dropdown @endslot
							@endcomponent 	

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent