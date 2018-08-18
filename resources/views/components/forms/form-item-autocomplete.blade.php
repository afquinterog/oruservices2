
{{--
  Autocomplete Usage
  

  @component('components.forms.form-item-autocomplete', [ ] )

		@slot('title') Buscar clientes  @endslot				  				  
		@slot('name') filter  @endslot				  
	  @slot('class') customer-autocomplete  @endslot
	  @slot('placeholder') Seleccione cliente  @endslot
	  @slot('id') customer @endslot
	  @slot('route') /find  -> (route on application) @endslot
	  @slot('filter') filter -> name of the filter sent to application @endslot

	  @slot('selectedText') ANDRES FELIPE QUINTERO GARCIA @endslot
	  @slot('selectedId') 1 @endslot

	  @slot('display') data.firstname + ' ' + data.lastname @endslot
	  @slot('suggestion') data.firstname + ' ' +  data.lastname + ' - @' + data.email @endslot  
	@endcomponent 

  --}}




<label class="form-control-label" 
			 for="{{ $name }}">
			{{ $title }}
</label>
<input type="search" name="{{$name}}" class="form-control {{ $class }}" placeholder="{{ $placeholder }}" autocomplete="off">
<input type="hidden" id="{{ $id }}" name="{{ $id }}" />



<script type="text/javascript">

	$( document ).ready(function() {


		// Set the Options for "Bloodhound" suggestion engine
  	var engine = new Bloodhound({
      remote: {
          url: '{{ $route }}?{{ $filter }}=%QUERY%',
          wildcard: '%QUERY%'
      },
      datumTokenizer: Bloodhound.tokenizers.whitespace,
      queryTokenizer: Bloodhound.tokenizers.whitespace
  	});


		$(".{{ $class }}").typeahead({
		      hint: true,
		      highlight: true,
		      minLength: 1

		  }, {
		  		//displayKey: 'id',
    			limit: 100,
		      source: engine.ttAdapter(),

		      display: function(data){
		      	return {{ $display }};
		      } ,

		      // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
		      name: 'dataList',

		      // the key from the array we want to display (name,id,email,etc...)
		      templates: {
		          empty: [
		              '<div class="list-group search-results-dropdown"><div class="list-group-item">No hay resultados.</div></div>'
		          ],
		          header: [
		              '<div class="list-group search-results-dropdown">'
		          ],
		          suggestion: function (data) {
		              return '<a class="list-group-item">' + {{ $suggestion }} + '</a>'
		    			}
		      }
		  });

		  $('.{{ $class }}').bind('typeahead:select', function(ev, suggestion) {
		  	//console.log('Selection: ' + suggestion.id + ' ' + suggestion.firstname );
		  	console.log('in component' + suggestion.id);
		  	$('#{{ $id }}').val( suggestion.id );

			});

		  @isset( $selectedText )
				$('.{{ $class }}').typeahead('val', "{{ $selectedText }}" );
			@endisset

			@isset( $selectedId )
				$('#{{ $id }}').val(" {{ $selectedId }}");
			@endisset

		});




</script>





<script type="text/javascript">

	// $( document ).ready(function() {


	// 	// Set the Options for "Bloodhound" suggestion engine
 //  	var engine = new Bloodhound({
 //      remote: {
 //          url: '/find?q=%QUERY%',
 //          wildcard: '%QUERY%'
 //      },
 //      datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
 //      queryTokenizer: Bloodhound.tokenizers.whitespace
 //  	});


	// 	$(".search-input").typeahead({
	// 	      hint: true,
	// 	      highlight: true,
	// 	      minLength: 1
	// 	  }, {
	// 	      source: engine.ttAdapter(),

	// 	      display: function(data){
	// 	      	return data.firstname + ' ' + data.lastname
	// 	      } ,

	// 	      // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
	// 	      name: 'usersList',

	// 	      // the key from the array we want to display (name,id,email,etc...)
	// 	      templates: {
	// 	          empty: [
	// 	              '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
	// 	          ],
	// 	          header: [
	// 	              '<div class="list-group search-results-dropdown">'
	// 	          ],
	// 	          suggestion: function (data) {
	// 	              return '<a class="list-group-item">' + data.firstname + ' ' +  data.lastname + ' - @' + data.email + '</a>'
	// 	    }
	// 	      }
	// 	  });

	// 	  $('.search-input').bind('typeahead:select', function(ev, suggestion) {
	// 	  	console.log('Selection: ' + suggestion.id + ' ' + suggestion.firstname );
	// 	  	console.log('in component');
	// 	  	$('#customer').val( suggestion.id );

	// 		});
	// 	});


</script>