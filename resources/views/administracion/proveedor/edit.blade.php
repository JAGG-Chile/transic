@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editando Proveedor ID: {{$proveedor->id}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		{!!Form::model($proveedor,['method'=>'PATCH','route'=>['administracion.proveedor.update',$proveedor->id]])!!}
		{{Form::token()}}
		
		<!-- Este input hidden es necesario para que funcione la validacion de campo unico en FormRequest -->
		<input type="hidden" name="id" type="text" value="{{ $proveedor->id }}">
		
		<div class="form-group">
			<label for="rut">Rut</label>
			<input type="text" name="rut" class="form-control" value="{{$proveedor->rut}}" required>
		</div>		
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" class="form-control" value="{{$proveedor->nombre}}" required>
		</div>
		<div class="form-group">
			<label for="direccion">Dirección</label>
			<input type="text" name="direccion" class="form-control" value="{{$proveedor->direccion}}">
		</div>		
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input type="number" name="telefono" class="form-control" value="{{$proveedor->telefono}}">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" value="{{$proveedor->email}}">
		</div>						
		<div class="form-group">
			<button class="btn btn-success" type="Submit">Guardar</button>
			<button class="btn btn-default" type="button"><a href="{{url('administracion/proveedor')}}">Cancelar y Volver atrás</a></button>
		</div>

		{!!Form::close()!!}
	</div>
</div>
@endsection