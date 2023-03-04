@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Marcas <a href="marca/create"><button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp&nbspAgregar Marca</button></a></h3>
		@include('administracion.marca.search')
	</div>
</div>
	
<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-10 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th class="text-center" width="10%">ID</th>
						<th class="text-center" width="60%">Nombre</th>
						<th class="text-center" width="10%">Estado</th>	
						<th class="text-center" width="20%">Acciones</th>
					</thead>
					@foreach($marcas as $marca)
					<tr>
						<td class="text-center">{{$marca->id}}</td>
						<td>{{$marca->nombre}}</td>					
						@if($marca->condicion)
							<td class="text-center">Activo</td>
						@else
							<td class="text-center">Inactivo</td>
						@endif
						<td class="text-center">							
							@if($marca->condicion)
								<a href="{{URL::action('MarcaController@edit',$marca->id)}}"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>							
								<a href="" data-target="#modal-delete-{{$marca->id}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button></a>							
							@else
								<button class="btn btn-xs btn-primary" disabled><i class="fa fa-pencil"></i></button>
								<a href="" data-target="#modal-delete-{{$marca->id}}" data-toggle="modal"><button class="btn btn-xs btn-success"><i class="fa fa-check"></i></button></a>							
							@endif
						</td>
					</tr>
					@include('administracion.marca.modal')
					@endforeach
				</table>
			</div>
		
		<p>{{$marcas->total()}} registros en total | Página {{$marcas->CurrentPage()}} de {{$marcas->LastPage()}}</p>
		
		{!! $marcas->appends(['searchText' => $searchText])->links() !!}

		</div>
	</div>
	
@endsection