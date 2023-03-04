<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$marca->id}}">
{{form::open(array('action'=>array('MarcaController@destroy',$marca->id),'method'=>'delete'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			@if($marca->condicion)
				<h4 class="modal-title">Desactivar</h4>
			@else
				<h4 class="modal-title">Activar</h4>
			@endif
		</div>
		<div class="modal-body">
			@if($marca->condicion)
				<p>Una marca no se puede eliminar del sistema, pero se puede desactivar.<br/>Confirme que desea desactivar la Marca ID:{{$marca->id}} {{$marca->nombre}}</p>
			@else
				<p>La marca se encuentra desactivada, pero puede reactivarla.<br/>Confirme que desea reactivar la Marca ID:{{$marca->id}} {{$marca->nombre}}</p>
			@endif
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			@if($marca->condicion)
				<button type="submit" class="btn btn-danger">Sí, confirmo</button>
			@else
				<button type="submit" class="btn btn-success">Sí, confirmo</button>
			@endif
		</div>
	</div>
</div>	
{{Form::close()}}