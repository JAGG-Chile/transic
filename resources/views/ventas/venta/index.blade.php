@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('ventas.venta.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Cliente</th>
						<th>Tipo Documento</th>
						<th>Numero</th>
						<th>Fecha</th>
						<th>Vencimiento</th>
						<th>Pago</th>
						<th>Total</th>
						<th>Estado</th>
						<th></th>
						<th></th>
					</thead>
					@foreach($ventas as $v)
					<tr>
						<td>{{$v->idventa}}</td>
						<td>{{$v->nombre}}</td>
						<td>{{$v->tipodocumento}}</td>
						<td>{{$v->numero}}</td>
						<td>{{$v->fecha}}</td>
						<td>{{$v->vencimiento}}</td>
						<td>{{$v->pago}}</td>
						<td align="right">{{$v->totalventa}}</td>
						<td>{{$v->estado}}</td>
						<td>
							<a href="{{URL::action('VentaController@show',$v->idventa)}}"><button class="btn btn-xs btn-info">Detalles</button></a>
						</td>
						<td>
							<a href="" data-target="#modal-delete-{{$v->idventa}}" data-toggle="modal"><button class="btn btn-xs btn-danger">Anular</button></a>
						</td>
					</tr>
					@include('ventas.venta.modal')
					@endforeach
				</table>
			</div>
			
			<p>{{$ventas->total()}} registros en total | Página {{$ventas->CurrentPage()}} de {{$ventas->LastPage()}}</p>
			
			{!! $ventas->appends(['searchText' => $searchText])->links() !!}
			
		</div>
	</div>
@endsection