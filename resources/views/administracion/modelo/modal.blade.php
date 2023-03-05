<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$modelo->id}}">
{{form::open(array('action'=>array('ModeloController@destroy',$modelo->id),'method'=>'delete'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			@if($modelo->condicion)
				<h4 class="modal-title">Desactivar</h4>
			@else
				<h4 class="modal-title">Activar</h4>
			@endif
		</div>
		<div class="modal-body">
			@if($modelo->condicion)
				<p>Un modelo no se puede eliminar del sistema, pero se puede desactivar.<br/>Confirme que desea desactivar el modelo ID:{{$modelo->id}} {{$modelo->nombre}}</p>
			@else
				<p>El modelo se encuentra desactivado, pero puede reactivarlo.<br/>Confirme que desea reactivar el modelo ID:{{$modelo->id}} {{$modelo->nombre}}</p>
			@endif
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			@if($modelo->condicion)
				<button type="submit" class="btn btn-danger">Sí, confirmo</button>
			@else
				<button type="submit" class="btn btn-success">Sí, confirmo</button>
			@endif
		</div>
	</div>
</div>	
{{Form::close()}}