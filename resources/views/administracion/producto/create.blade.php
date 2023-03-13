@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

		<h3>Ingresando Nuevo Artículo</h3>

		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif


		{!!Form::Open(array('url'=>'administracion/producto','method'=>'POST','autocomplete'=>'off'))!!}
		{{Form::token()}}
				
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required class="form-control" placeholder="Nombre...">
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
				<label for="idProveedor">Proveedor</label>
				<select name="idProveedor" id="idProveedor" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
					@foreach($proveedores as $proveedor)
						<option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
					@endforeach
				</select>			
			</div>
			<div class="form-group">
				<label for="unidadMedida">Unidad de Medida</label>
				<select name="unidadMedida" id="unidadMedida" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
					<option value="UD" selected>Unidad</option>					
					<option value="PZ">Pieza</option>					
					<option value="PT">Parte</option>					
					<option value="LT">Litro</option>					
				</select>			
			</div>
			<div class="form-group">
				<label for="saldoInicial">Saldo Inicial</label>
				<input type="number" name="saldoInicial" class="form-control">
			</div>
			<div class="form-group">
				<label for="stockMinimo">Stock Mínimo</label>
				<input type="number" name="stockMinimo" class="form-control">
			</div>						
			<div class="form-group">
				<button class="btn btn-success" type="Submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Guardar</button>
				<button class="btn btn-info" type="reset"><i class="fa fa-ban"></i>&nbsp;&nbsp;Cancelar y Regresar Atrás</button>
			</div>
	</div>
</div>
{!!Form::close()!!}

@endsection