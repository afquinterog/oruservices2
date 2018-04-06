

	@component('components.table')

			
				@slot('columns')
					 <th> {{ "Nombre" }} </th>
				@endslot

				@foreach ( $user->roles as $role)

	        <tr>
	        	<td>{{ $role->name }}</td>
		      </tr>

	   		@endforeach
							

		@endcomponent


		@include('users.edit-roles-form')

		


