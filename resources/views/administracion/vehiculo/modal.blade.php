<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$vehiculo->id}}">
{{form::open(array('action'=>array('VehiculoController@destroy',$vehiculo->id),'method'=>'delete'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			@if($vehiculo->condicion)
				<h4 class="modal-title">Desactivar</h4>
			@else
				<h4 class="modal-title">Activar</h4>
			@endif
		</div>
		<div class="modal-body">
			@if($vehiculo->condicion)
				<p>Un Vehiculo no se puede eliminar del sistema, pero se puede desactivar.<br/>Confirme que desea desactivar el Vehiculo ID:{{$vehiculo->id}} {{$vehiculo->ppu}}</p>
			@else
				<p>El Vehiculo se encuentra desactivado, pero puede reactivarlo.<br/>Confirme que desea reactivar el vehiculo ID:{{$vehiculo->id}} {{$vehiculo->ppu}}</p>
			@endif
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			@if($vehiculo->condicion)
				<button type="submit" class="btn btn-danger">Sí, confirmo</button>
			@else
				<button type="submit" class="btn btn-success">Sí, confirmo</button>
			@endif
		</div>
	</div>
</div>	
{{Form::close()}}