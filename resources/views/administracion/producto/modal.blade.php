<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$a->id}}">
{{form::open(array('action'=>array('ProductoController@destroy',$a->id),'method'=>'delete'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			@if($a->condicion)
				<h4 class="modal-title">Desactivar</h4>
			@else
				<h4 class="modal-title">Activar</h4>
			@endif
		</div>
		<div class="modal-body">
			@if($a->condicion)
				<p>Un Artículo no se puede eliminar del sistema, pero se puede desactivar.<br/>Confirme que desea desactivar el Artículo ID:{{$a->id}} {{$a->nombre}}</p>
			@else
				<p>El Artículo se encuentra desactivado, pero puede reactivarlo.<br/>Confirme que desea reactivar el Artículo ID:{{$a->id}} {{$a->nombre}}</p>
			@endif			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			@if($a->condicion)
				<button type="submit" class="btn btn-danger">Sí, confirmo</button>
			@else
				<button type="submit" class="btn btn-success">Sí, confirmo</button>
			@endif
		</div>
		</div>
	</div>
</div>	
{{Form::close()}}