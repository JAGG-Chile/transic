@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editando modelo ID: {{$modelos->id}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		{!!Form::model($modelos,['method'=>'PATCH','route'=>['administracion.modelo.update',$modelos->id]])!!}
		{{Form::token()}}
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" class="form-control" value="{{$modelos->nombre}}">
		</div>		
		<div class="form-group">
			<button class="btn btn-success" type="Submit">Guardar</button>
			<button class="btn btn-default" type="button"><a href="{{url('administracion/modelo')}}">Cancelar y Volver atrás</a></button>
		</div>

		{!!Form::close()!!}
	</div>
</div>
@endsection