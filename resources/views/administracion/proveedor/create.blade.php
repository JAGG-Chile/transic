@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		
		<h3>Ingresando Nuevo Proveedor</h3>

		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		{!!Form::Open(array('url'=>'administracion/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
		{{Form::token()}}
		<div class="form-group">
			<label for="nombre">Rut</label>
			<input type="text" name="rut" class="form-control" placeholder="99999999-9" required>
		</div>
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" class="form-control" placeholder="Nombre de proveedor" required>			
		</div>		
		<div class="form-group">
			<label for="nombre">Dirección</label>
			<input type="text" name="direccion" class="form-control" placeholder="Direccion del proveedor">			
		</div>
		<div class="form-group">
			<label for="nombre">Teléfono</label>
			<input type="number" name="telefono" class="form-control" placeholder="999999999">			
		</div>
		<div class="form-group">
			<label for="nombre">Email</label>
			<input type="email" name="email" class="form-control" placeholder="correo@proveedor.cl">			
		</div>
		<div class="form-group">
			<button class="btn btn-success" type="Submit">Guardar</button>
			<button class="btn btn-default" type="button"><a href="{{url('administracion/proveedor')}}">Cancelar y Volver atrás</a></button>
		</div>		
		{!!Form::close()!!}
	</div>	
</div>
@endsection