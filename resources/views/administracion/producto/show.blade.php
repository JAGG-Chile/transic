@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label><h3>Cuenta Corriente por Producto</h3></label>
			<label>{{$producto->nombre}}</label>
			<label>{{$desde}}</label>
			<label>{{$hasta}}</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="panel panel-primary">
		<div class="panel-body">
			
			<div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
				<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">
						
						<th>Fecha</th>
						<th>Docto</th>
						<th>Proveedor / Cliente</th>
						<th>Ingreso</th>
						<th>Egreso</th>
					</thead>
					<tfoot>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tfoot>
					<tbody>
						<?php
						$ingresos=0;
						$egresos=0;
						?>
						@foreach($venta as $v)
						<tr>
							<td>{{date('d-m-Y',strtotime($v->fecha))}}</td>
							<td>{{substr($v->documento,1)}}</td>
							<td>{{$v->nombre}}</td>
							<?php
							if (substr($v->documento,0,1)=="C")
							{?>
								<td>{{$v->cantidad}}</td>
								<td></td>
							<?php
								$ingresos=$ingresos+$v->cantidad;
							}
							else
							{?>
								<td></td>
								<td>{{$v->cantidad}}</td>
							<?php
								$egresos=$egresos+$v->cantidad;
							}?>
						</tr>
						@endforeach
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th>{{$ingresos}}</th>
							<th>{{$egresos}}</th>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>
@endsection