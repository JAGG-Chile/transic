<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$proveedor->id}}">
{{form::open(array('action'=>array('ProveedorController@destroy',$proveedor->id),'method'=>'delete'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			@if($proveedor->condicion)
				<h4 class="modal-title">Desactivar</h4>
			@else
				<h4 class="modal-title">Activar</h4>
			@endif
		</div>
		<div class="modal-body">
			@if($proveedor->condicion)
				<p>Un proveedor no se puede eliminar del sistema, pero se puede desactivar.<br/>Confirme que desea desactivar el proveedor ID:{{$proveedor->id}} {{$proveedor->nombre}}</p>
			@else
				<p>El proveedor se encuentra desactivado, pero puede reactivarlo.<br/>Confirme que desea reactivar el proveedor ID:{{$proveedor->id}} {{$proveedor->nombre}}</p>
			@endif
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			@if($proveedor->condicion)
				<button type="submit" class="btn btn-danger">Sí, confirmo</button>
			@else
				<button type="submit" class="btn btn-success">Sí, confirmo</button>
			@endif
		</div>
	</div>
</div>	
{{Form::close()}}