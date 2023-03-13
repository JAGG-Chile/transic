@extends ('layouts.admin')
@section ('contenido')

	
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Productos <a href="producto/create"><button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp&nbspNuevo</button></a></h3>
			@include('administracion.producto.search')
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Disponible</th>
						<th>Unidad</th>
						<th>Estado</th>
						<th></th>
						<th></th>
					</thead>
					@foreach($articulos as $a)
					<tr>
						<td>{{$a->id}}</td>
						<td>{{$a->nombre}}</td>
						<td>{{$a->nombreMarca}}</td>
						<td>{{$a->nombreModelo}}</td>
						<td>{{number_format($a->stockActual,2,",",".")}}</td>
						<td>{{$a->unidadMedida}}</td>
						
						@if($a->condicion)
							<td class="text-center">Activo</td>
						@else
							<td class="text-center">Inactivo</td>
						@endif
						<td class="text-center">							
							@if($a->condicion)
								<a href="{{URL::action('ProductoController@edit',$a->id)}}"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button></a>							
								<a href="" data-target="#modal-delete-{{$a->id}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button></a>							
							@else
								<button class="btn btn-xs btn-warning" disabled><i class="fa fa-pencil"></i></button>
								<a href="" data-target="#modal-delete-{{$a->id}}" data-toggle="modal"><button class="btn btn-xs btn-success"><i class="fa fa-check"></i></button></a>							
							@endif
						</td>
						
					</tr>
					@include('administracion.producto.modal')
					@endforeach
				</table>
			</div>
			<p>{{$articulos->total()}} registros en total | Página {{$articulos->CurrentPage()}} de {{$articulos->LastPage()}}</p>
			
			{!! $articulos->appends(['searchText' => $searchText])->links() !!}
			
		</div>
	</div>

@endsection