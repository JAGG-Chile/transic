@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		
		<h3>Ingresando Nuevo Vehículo</h3>

		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		{!!Form::Open(array('url'=>'administracion/vehiculo','method'=>'POST','autocomplete'=>'off'))!!}
		{{Form::token()}}
		<div class="form-group">
			<label for="ppu">PPU</label>
			<input type="text" name="ppu" class="form-control" pattern="[A-Za-z]{2}[A-Za-z0-9]{4}" placeholder="AAAA99 ó AA9999" required>			
		</div>		
		<div class="form-group">
			<label for="idMarca">Marca</label>
			<select name="idMarca" id="idMarca" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
				@foreach($marcas as $marca)
					<option value="{{$marca->id}}">{{$marca->nombre}}</option>
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="idModelo">Modelo</label>
			<select name="idModelo" id="idModelo" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
				@foreach($modelos as $modelo)
					<option value="{{$modelo->id}}">{{$modelo->nombre}}</option>
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="tipo">Tipo</label>
			<select name="tipo" id="tipo" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
				<option value="Bus" selected>Bus</option>
				<option value="Camion">Camión</option>
				<option value="Maquina">Máquinaria</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="combustible">Combustible</label>
			<select name="combustible" id="combustible" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
				<option value="Petroleo" selected>Petróleo</option>
				<option value="Bencina">Bencina</option>
				<option value="Gas">Gas</option>
				<option value="Otro">Otro</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="anio">Año</label>
			<input type="text" name="anio" class="form-control" pattern="[0-9]{4}" placeholder="9999" required>
		</div>	 
		<div class="form-group">
			<button class="btn btn-success" type="Submit"><i class="fa fa-check"></i>&nbsp&nbspGuardar</button>
			<button class="btn btn-default" type="button"><a href="{{url('administracion/vehiculo')}}"><i class="fa fa-ban"></i>&nbsp&nbspCancelar y Volver atrás</a></button>
		</div>		
		{!!Form::close()!!}
	</div>	
</div>
@push('scripts')
<script>
	//Llenar año con un select
</script>
@endpush
@endsection