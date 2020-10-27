@extends ('layouts.admin')
@section ('contenido')

	
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Productos <a href="producto/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('almacen.producto.search')
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Categoría</th>
						<th>Proveedor</th>
						<th>Precio</th>
						<th>Stock</th>
						<th>Tipo</th>
						<th></th>
						<th></th>
					</thead>
					@foreach($productos as $p)
					<tr>
						<td>{{$p->idproducto}}</td>
						<td>{{$p->nombre}}</td>
						<td>{{$p->descripcion}}</td>
						<td>{{$p->categoria}}</td>
						<td>{{$p->proveedor}}</td>
						<td>{{$p->precio}}</td>
						<td>{{number_format($p->stockactual,2,",",".")}}</td>
						<td>{{$p->tipo}}</td>
						<td>
							<a href="{{URL::action('ProductoController@edit',$p->idproducto)}}"><button class="btn btn-xs btn-info" size=>Editar</button></a>
						</td>
						<td>
							<a href="" data-target="#modal-delete-{{$p->idproducto}}" data-toggle="modal"><button class="btn btn-xs btn-danger">Eliminar</button></a>
						</td>
						<!--<td>
							<a href="{{URL::action('ProductoController@show',$p->idproducto)}}"><button type="submit" class="btn btn-xs btn-warning">Cta.Cte.</button></a>
						</td>
						<td>
							<a href="{{URL::action('PdfController@crear_reporte_cuentasxcobrar_producto',$p->idproducto)}}" target="_blank"><button type="submit" class="btn btn-xs btn-warning">Ventas</button></a>
						</td>-->
					</tr>
					@include('almacen.producto.modal')
					@endforeach
				</table>
			</div>
			<p>{{$productos->total()}} registros en total | Página {{$productos->CurrentPage()}} de {{$productos->LastPage()}}</p>
			
			{!! $productos->appends(['searchText' => $searchText])->links() !!}
			
		</div>
	</div>

@endsection