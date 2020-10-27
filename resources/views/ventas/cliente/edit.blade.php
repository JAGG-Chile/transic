@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Cliente: {{$personas->nombre}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
{!!Form::model($personas,['method'=>'PATCH','route'=>['ventas.cliente.update',$personas->idpersona]])!!}
{{Form::token()}}
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" required value="{{$personas->nombre}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="rut">Rut</label>
			<input type="text" name="rut" required value="{{$personas->rut}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="direccion">Dirección</label>
			<input type="text" name="direccion" required value="{{$personas->direccion}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="contacto">Contacto</label>
			<input type="text" name="contacto" required value="{{$personas->contacto}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input type="text" name="telefono" required value="{{$personas->telefono}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" name="email" required value="{{$personas->email}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="descuento">Descuento (%)</label>
			<input type="text" name="descuento" value="{{$personas->descuento}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="credito">Crédito (Días)</label>
			<input type="text" name="credito" value="{{$personas->credito}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<button class="btn btn-primary" type="Submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>
</div>
		
{!!Form::close()!!}

@endsection