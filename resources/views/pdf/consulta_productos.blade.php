@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Ventas por Producto</h3>
	</div>
</div>
	
{!!Form::Open(array('url'=>'resultado_productos','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	
	<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="producto">Producto</label>
			<select name="idproducto" id="idproducto" class="form-control selectpicker" data-live-search="true" title="Elija un Producto..." data-size="5" required>
				@foreach($productos as $productos)
				<option value="{{$productos->idproducto}}">{{$productos->producto}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="cliente">Cliente</label>
			<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" title="Elija un Cliente..." data-size="5">
				@foreach($personas as $personas)
				<option value="{{$personas->idpersona}}">{{$personas->nombre}}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="desde">Desde</label>
			<input type="date" name="desde" required class="form-control" placeholder="Desde...">
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="hasta">Hasta</label>
			<input type="date" name="hasta" required class="form-control" placeholder="hasta...">
		</div>
	</div>

	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<button class="btn btn-success" type="submit" target='_blank'>Buscar</button></a>
	</div>
</div>
{!!Form::close()!!}

@endsection