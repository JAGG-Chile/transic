@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Compras <a href="compra/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('compras.compra.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Proveedor</th>
						<th>Tipo Documento</th>
						<th>Numero</th>
						<th>Fecha</th>
						<th>Vencimiento</th>
						<th>Carpeta</th>
						<th>Total</th>
						<th>Estado</th>
						<th></th>
						<th></th>
					</thead>
					@foreach($compras as $c)
					<tr>
						<td>{{$c->idcompra}}</td>
						<td>{{$c->nombre}}</td>
						<td>{{$c->tipodocumento}}</td>
						<td>{{$c->numero}}</td>
						<td>{{$c->fecha}}</td>
						<td>{{$c->vencimiento}}</td>
						<td>{{$c->carpeta}}</td>
						<td>{{$c->total}}</td>
						<td>{{$c->estado}}</td>
						<td>
							<a href="{{URL::action('CompraController@show',$c->idcompra)}}"><button class="btn btn-xs btn-info">Detalle</button></a>
						</td>
						<td>
							<a href="" data-target="#modal-delete-{{$c->idcompra}}" data-toggle="modal"><button class="btn btn-xs btn-danger">Anular</button></a>
						</td>
					</tr>
					@include('compras.compra.modal')
					@endforeach
				</table>
			</div>
			
			<p>{{$compras->total()}} registros en total | Página {{$compras->CurrentPage()}} de {{$compras->LastPage()}}</p>
			
			{!! $compras->appends(['searchText' => $searchText])->links() !!}
			
		</div>
	</div>
@endsection