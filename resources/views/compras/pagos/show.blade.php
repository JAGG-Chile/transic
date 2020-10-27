@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="proveedor">Proveedor</label>
			<p>{{$compra->nombre}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Documento</label>
			<p>{{$compra->tipodocumento}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="numero">Numero</label>
			<p>{{$compra->numero}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="fecha">Fecha</label>
			<p>{{$compra->fecha}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="vencimiento">Vencimiento</label>
			<p>{{$compra->vencimiento}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="carpeta">Carpeta</label>
			<p>{{$compra->carpeta}}</p>
		</div>
	</div>
</div>
<div class="row">	
	<div class="panel panel-primary">
		<div class="panel-body">
			
			<div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
				<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">
						
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Subtotal</th>
					</thead>
					<tfoot>
						<th></th>
						<th></th>
						<th></th>
						<th><h4 id="total">{{$compra->total}}</h4></th>
					</tfoot>
					<tbody>
						@foreach($detalle as $det)
						<tr>
							<td>{{$det->producto}}</td>
							<td>{{$det->cantidad}}</td>
							<td>{{$det->preciounitario}}</td>
							<td>{{$det->cantidad*$det->preciounitario}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>
		

@endsection