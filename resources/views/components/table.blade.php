
 <div class="row" style="margin-bottom:20px">
    <div class="col-lg-10">
      
    @if ( isset($filters) )
        {{ $filters }} 
    @endif
    
    </div>
      <div class="col-lg-2">
          {{-- <div class="panel-actions">
              <a class="panel-action icon wb-edit" data-toggle="tooltip" data-original-title="edit" data-container="body" title=""></a>
              <a class="panel-action icon wb-reply" data-toggle="tooltip" data-original-title="send" data-container="body" title=""></a>
              <a class="panel-action icon wb-trash" data-toggle="tooltip" data-original-title="move to trash" data-container="body" title=""></a>
              <a class="panel-action icon wb-user" data-toggle="tooltip" data-original-title="uesrs" data-container="body" title=""></a>
          </div> --}}
      </div>
    </div>


{{-- Additional filters --}}
{{-- <div class="row" style="margin-top:20px">
    <div class="col-lg-10">
      

    <form class="form-inline">
                <div class="form-group">
                  <label class="sr-only" for="inputInlineUsername">Filtro</label>
                  <input type="text" class="form-control" id="inputInlineUsername" name="inputUsername" placeholder="Username" autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="sr-only" for="inputInlinePassword">Cliente</label>
                  <input type="text" class="form-control" id="inputInlinePassword" name="inputPassword" placeholder="Password" autocomplete="off">
                </div>

                <div class="form-group">
                  <div class="checkbox-custom checkbox-default">
                    <input type="checkbox" id="inputInlineRemember" name="inputCheckboxRemember" checked="" autocomplete="off">
                    <label for="inputInlineRemember">Activos</label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-outline">Actualizar</button>
                </div>
              </form>

    </div>
      <div class="col-lg-2">
        <div class="panel-actions">
              <a class="panel-action icon wb-edit" data-toggle="tooltip" data-original-title="edit" data-container="body" title=""></a>
              <a class="panel-action icon wb-reply" data-toggle="tooltip" data-original-title="send" data-container="body" title=""></a>
              <a class="panel-action icon wb-trash" data-toggle="tooltip" data-original-title="move to trash" data-container="body" title=""></a>
              <a class="panel-action icon wb-user" data-toggle="tooltip" data-original-title="uesrs" data-container="body" title=""></a>
            </div>
        </div>
</div> --}}

<div class="row">

  <div class="col-xs-12 col-lg-12">
  

  <div class="data">
  	<h4 class="data-title">
  		@if ( isset($title) )
  			{{ $title }}
  		@endif
  	</h4>
    
    	


      <div class="data table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
            	{{ $columns }}
             
            </tr>
          </thead>
          <tbody>

          	{{ $slot }}
            
         
          </tbody>
        </table>
      </div>
  </div>

  </div>

</div>