@extends ('layouts.admin')
@section ('contenido')
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editando Producto: {{$articulo->id}} {{$articulo->nombre}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	

	{!!Form::model($articulo,['method'=>'PATCH','route'=>['administracion.producto.update',$articulo->id]])!!}
	{{Form::token()}}
				
	<div class="form-group">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" required class="form-control" value="{{$articulo->nombre}}" required>
	</div>
	
	<div class="form-group">
		<label for="idMarca">Marca</label>
		<select name="idMarca" id="idMarca" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
			@foreach($marcas as $marca)
				<option value="{{$marca->id}}" <?php if($marca->id == $articulo->id_marca){ echo "selected"; }?>>{{$marca->nombre}}</option>
			@endforeach
		</select>			
	</div>
	<div class="form-group">
		<label for="idModelo">Modelo</label>
		<select name="idModelo" id="idModelo" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
			@foreach($modelos as $modelo)
				<option value="{{$modelo->id}}" <?php if($modelo->id == $articulo->id_modelo){ echo "selected"; }?>>{{$modelo->nombre}}</option>
			@endforeach
		</select>			
	</div>
	<div class="form-group">
		<label for="idProveedor">Proveedor</label>
		<select name="idProveedor" id="idProveedor" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
			@foreach($proveedores as $proveedor)
				<option value="{{$proveedor->id}}" <?php if($proveedor->id == $articulo->id_proveedor){ echo "selected"; }?>>{{$proveedor->nombre}}</option>
			@endforeach
		</select>			
	</div>
	<div class="form-group">
		<label for="unidadMedida">Unidad de Medida</label>
		<select name="unidadMedida" id="unidadMedida" class="form-control selectpicker" data-live-search="true" title="Seleccione..." data-size="7" required>
			<option value="UD" <?php if($articulo->unidadMedida == "UD"){ echo "selected"; }?>>Unidad</option>					
			<option value="PZ" <?php if($articulo->unidadMedida == "PZ"){ echo "selected"; }?>>Pieza</option>					
			<option value="PT" <?php if($articulo->unidadMedida == "PT"){ echo "selected"; }?>>Parte</option>					
			<option value="LT" <?php if($articulo->unidadMedida == "LT"){ echo "selected"; }?>>Litro</option>					
		</select>			
	</div>
	{{-- <div class="form-group">   NO DEBIERA PODER MODIFICARSE EL SALDO INICIAL O EL SALDO DISPONIBLE
		<label for="saldoInicial">Saldo Inicial</label>
		<input type="number" name="saldoInicial" class="form-control" value="{{$articulo->saldoInicial}}">
	</div> --}}
	<div class="form-group">
		<label for="stockMinimo">Stock Mínimo</label>
		<input type="number" name="stockMinimo" class="form-control" value="{{$articulo->stockMinimo}}">
	</div>						
	<div class="form-group">
		<button class="btn btn-success" type="Submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Guardar</button>
		<button class="btn btn-info" type="reset"><i class="fa fa-ban"></i>&nbsp;&nbsp;Cancelar y Regresar Atrás</button>
	</div>		
	{!!Form::close()!!}
</div>
@endsection