 
 <form action="{{$route}}" method="POST" style="display:inline">

 	@method($method)
 	@csrf

	 <button type="submit" class="btn btn-sm btn-icon btn-flat btn-default" 
	 	       data-toggle="tooltip" data-original-title="{{ $title }}" >
	  	<i class="icon {{ $icon }}" aria-hidden="true"></i>
	  

	  	@foreach ($data as $id => $value)
	    	@isset($id) 	<input type="hidden" value="{{$value}}" name="{{$id}}"> @endisset	
			@endforeach

	  	
	</button>
</form>


{{-- Usage:

	@component('components.forms.form-item-form-button', 
						[ 'data' => ['service' => $serviceType->id , 'task' => $task->id  ] ] )

						@slot('route') {{ "/service-type/task/delete"  }} @endslot
						@slot('method') DELETE @endslot
						@slot('title') {{ __('messages.disable') }} @endslot
						@slot('icon')  wb-close @endslot
					@endcomponent --}}
