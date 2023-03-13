@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Vehículos <a href="vehiculo/create"><button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp&nbspAgregar Vehículo</button></a></h3>
		@include('administracion.vehiculo.search')
	</div>
</div>
	
<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-10 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th class="text-center" width="10%">ID</th>
						<th class="text-center" width="10%">Patente</th>
						<th class="text-center" width="20%">Marca</th>	
						<th class="text-center" width="20%">Modelo</th>
						<th class="text-center" width="10%">Tipo</th>	
						<th class="text-center" width="10%">Estado</th>
						<th class="text-center" width="20%">Acciones</th>
					</thead>
					@foreach($vehiculos as $vehiculo)
					<tr>
						<td class="text-center">{{$vehiculo->id}}</td>
						<td>{{$vehiculo->ppu}}</td>					
						<td>{{$vehiculo->nombreMarca}}</td>
						<td>{{$vehiculo->nombreModelo}}</td>
						<td>{{$vehiculo->tipo}}</td>
						@if($vehiculo->condicion)
							<td class="text-center">Activo</td>
						@else
							<td class="text-center">Inactivo</td>
						@endif
						<td class="text-center">							
							@if($vehiculo->condicion)
								<a href="{{URL::action('VehiculoController@edit',$vehiculo->id)}}"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button></a>							
								<a href="" data-target="#modal-delete-{{$vehiculo->id}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button></a>							
							@else
								<button class="btn btn-xs btn-warning" disabled><i class="fa fa-pencil"></i></button>
								<a href="" data-target="#modal-delete-{{$vehiculo->id}}" data-toggle="modal"><button class="btn btn-xs btn-success"><i class="fa fa-check"></i></button></a>							
							@endif
						</td>
					</tr>
					@include('administracion.vehiculo.modal')
					@endforeach
				</table>
			</div>
		
		<p>{{$vehiculos->total()}} registros en total | Página {{$vehiculos->CurrentPage()}} de {{$vehiculos->LastPage()}}</p>
		
		{!! $vehiculos->appends(['searchText' => $searchText])->links() !!}

		</div>
	</div>
	
@endsection