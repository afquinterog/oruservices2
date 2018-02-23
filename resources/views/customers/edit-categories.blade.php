

	@component('components.table')

			
				@slot('columns')
					 <th> {{ "Nombre" }} </th>
	         <th> {{ "Descripción" }}</th>
	         <th class="text-nowrap">{{ __('messages.actions') }}</th>
				@endslot

				@foreach ( $categories as $categ)

	        <tr>
	        	<td>{{ $categ->name }}</td>
	        	<td>{{ $categ->description }}</td>

	        	<td class="text-nowrap">

							@component('components.table-option')
								@slot('title') {{ __("Subir") }} @endslot
								@slot('route') 
									{{ url( "/categories/{$categ->id}/orderUp/customer/{$customer->id}") }}
								@endslot 
								@slot('icon') wb-dropup @endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __("Bajar") }} @endslot
								@slot('route')
									{{ url( "/categories/{$categ->id}/orderDown/customer/{$customer->id}") }}
								@endslot
								@slot('icon') wb-dropdown @endslot
							@endcomponent 	

							@component('components.table-option')
								@slot('title') {{ __('messages.disable') }} @endslot
								@slot('route') {{ url("categories/{$categ->id}/customer/{$customer->id}/delete") }} @endslot
								@slot('icon') wb-close @endslot
							@endcomponent 	

	        	</td>
		      </tr>

	   		@endforeach
							

		@endcomponent


		@include('customers.edit-categories-form')
