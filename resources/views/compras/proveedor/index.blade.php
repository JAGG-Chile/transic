@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('compras.proveedor.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Rut</th>
						<th>Dirección</th>
						<th>Contacto</th>
						<th>Teléfono</th>
						<th>Email</th>
						<th></th>
						<th></th>
					</thead>
					@foreach($personas as $per)
					<tr>
						<td>{{$per->idpersona}}</td>
						<td>{{$per->nombre}}</td>
						<td>{{$per->rut}}</td>
						<td>{{$per->direccion}}</td>
						<td>{{$per->contacto}}</td>
						<td>{{$per->telefono}}</td>
						<td>{{$per->email}}</td>
						<td>
							<a href="{{URL::action('ProveedorController@edit',$per->idpersona)}}"><button class="btn btn-xs btn-info">Editar</button></a>
						</td>
						<td>
							<a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-xs btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('compras.proveedor.modal')
					@endforeach
				</table>
			</div>
			<p>{{$personas->total()}} registros en total | Página {{$personas->CurrentPage()}} de {{$personas->LastPage()}}</p>
			
			{!! $personas->appends(['searchText' => $searchText])->links() !!}
			
		</div>
	</div>
@endsection