@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editando Vehiculo ID: {{$vehiculo->id}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		{!!Form::model($vehiculo,['method'=>'PATCH','route'=>['administracion.vehiculo.update',$vehiculo->id]])!!}
		{{Form::token()}}
		<input type="hidden" name="id" value="{{$vehiculo->id}}">   <!-- necesrio para validar ppu unico en tabla -->
		<div class="form-group">
			<label for="ppu">PPU</label>
			<input type="text" name="ppu" class="form-control" pattern="[A-Za-z]{2}[A-Za-z0-9]{4}" value="{{$vehiculo->ppu}}" required>			
		</div>		
		<div class="form-group">
			<label for="idMarca">Marca</label>
			<select name="idMarca" id="idMarca" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
				@foreach($marcas as $marca)
					<option value="{{$marca->id}}" <?php if($marca->id == $vehiculo->id_marca){ echo 'selected';} ?>>{{$marca->nombre}}</option>
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="idModelo">Modelo</label>
			<select name="idModelo" id="idModelo" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
				@foreach($modelos as $modelo)
					<option value="{{$modelo->id}}" <?php if($modelo->id == $vehiculo->id_modelo){ echo 'selected'; }?>>{{$modelo->nombre}}</option>
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="tipo">Tipo</label>
			<select name="tipo" id="tipo" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
				<option value="Bus" <?php if($vehiculo->tipo == 'Bus'){ echo 'selected'; }?>>Bus</option>
				<option value="Camion" <?php if($vehiculo->tipo == 'Camion'){ echo 'selected'; }?>>Camión</option>
				<option value="Maquina"  <?php if($vehiculo->tipo == 'Maquina'){ echo 'selected'; }?>>Máquinaria</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="combustible">Combustible</label>
			<select name="combustible" id="combustible" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
				<option value="Petroleo" <?php if($vehiculo->combustible == 'Petroleo'){ echo 'selected'; }?>>Petróleo</option>
				<option value="Bencina" <?php if($vehiculo->combustible == 'Bencina'){ echo 'selected'; }?>>Bencina</option>
				<option value="Gas" <?php if($vehiculo->combustible == 'Gas'){ echo 'selected'; }?>>Gas</option>
				<option value="Otro" <?php if($vehiculo->combustible == 'Otro'){ echo 'selected'; }?>>Otro</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="anio">Año</label>
			<input type="text" name="anio" class="form-control" pattern="[0-9]{4}" value="{{$vehiculo->anio}}" required>
		</div>	 
		
		<div class="form-group">
			<button class="btn btn-success" type="Submit">Guardar</button>
			<button class="btn btn-default" type="button"><a href="{{url('administracion/marca')}}">Cancelar y Volver atrás</a></button>
		</div>

		{!!Form::close()!!}
	</div>
</div>
@endsection