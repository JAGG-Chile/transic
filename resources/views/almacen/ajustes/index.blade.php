@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Ajustes <a href="almacen/ajustes/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('almacen.ajustes.search')
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Fecha</th>
						<th>Codigo</th>
						<th>Producto</th>
						<th>Movimiento</th>
						<th>Cantidad</th>
						<th>Glosa</th>
						<th>Estado</th>
						<th></th>
						<th></th>
					</thead>
					@foreach($ajustes as $a)
					<tr>
						<td>{{$a->idajustes}}</td>
						<td>{{$a->fecha}}</td>
						<td>{{$a->idproducto}}</td>
						<td>{{$a->producto}}</td>
						<td>{{$a->movto}}</td>
						<td>{{number_format($a->cantidad,2,",",".")}}</td>
						<td>{{$a->glosa}}</td>
						<td>{{$a->estado}}</td>
						<td>
							<a href="{{URL::action('AjusteController@edit',$a->idajustes)}}"><button class="btn btn-xs btn-info" size=>Editar</button></a>
						</td>
						<td>
							<a href="" data-target="#modal-delete-{{$a->idajustes}}" data-toggle="modal"><button class="btn btn-xs btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('almacen.ajustes.modal')
					@endforeach
				</table>
			</div>
			<p>{{$ajustes->total()}} registros en total | Página {{$ajustes->CurrentPage()}} de {{$ajustes->LastPage()}}</p>
			
			{!! $ajustes->appends(['searchText' => $searchText])->links() !!}
			
		</div>
	</div>

@endsection