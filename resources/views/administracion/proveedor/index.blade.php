@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp&nbspAgregar Proveedor</button></a></h3>
		@include('administracion.proveedor.search')
	</div>
</div>
	
<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-10 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th class="text-center" width="5%">ID</th>
						<th class="text-center" width="10%">RUT</th>
						<th class="text-center" width="20%">Nombre</th>	
						<th class="text-center" width="20%">Dirección</th>
						<th class="text-center" width="10%">Teléfono</th>	
						<th class="text-center" width="15%">Email</th>	
						<th class="text-center" width="10%">Estado</th>	
						<th class="text-center" width="10%">Acciones</th>
					</thead>
					@foreach($proveedores as $proveedor)
					<tr>
						<td class="text-center">{{$proveedor->id}}</td>
						<td>{{$proveedor->rut}}</td>		
						<td>{{$proveedor->nombre}}</td>					
						<td>{{$proveedor->direccion}}</td>		
						<td>{{$proveedor->telefono}}</td>		
						<td>{{$proveedor->email}}</td>		
						@if($proveedor->condicion)
							<td class="text-center">Activo</td>
						@else
							<td class="text-center">Inactivo</td>
						@endif
						<td class="text-center">							
							@if($proveedor->condicion)
								<a href="{{URL::action('ProveedorController@edit',$proveedor->id)}}"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button></a>							
								<a href="" data-target="#modal-delete-{{$proveedor->id}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button></a>							
							@else
								<button class="btn btn-xs btn-warning" disabled><i class="fa fa-pencil"></i></button>
								<a href="" data-target="#modal-delete-{{$proveedor->id}}" data-toggle="modal"><button class="btn btn-xs btn-success"><i class="fa fa-check"></i></button></a>							
							@endif
						</td>
					</tr>
					@include('administracion.proveedor.modal')
					@endforeach
				</table>
			</div>
		
		<p>{{$proveedores->total()}} registros en total | Página {{$proveedores->CurrentPage()}} de {{$proveedores->LastPage()}}</p>
		
		{!! $proveedores->appends(['searchText' => $searchText])->links() !!}

		</div>
	</div>
	
@endsection