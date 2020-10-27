@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nueva Venta</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
{!!Form::Open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="cliente">Cliente</label>
			<select name="cliente" id="cliente" class="form-control selectpicker" data-live-search="true" title="Elija un Cliente..." data-size="7">
				@foreach($personas as $persona)
				<option value="{{$persona->idpersona}}_{{$persona->descuento}}_{{$persona->credito}}">{{$persona->nombre}}</option>
				@endforeach
			</select>
			<input type="hidden" name="idcliente" id="idcliente">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label>Documento</label>
			<select name="tipodocumento" class="form-control">
				<option value="Factura">Factura</option>
				<option value="Boleta">Boleta</option>
				<option value="Ticket">Ticket</option>
			</select>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="numero">Numero</label>
			<input type="text" name="numero" id="numero" required class="form-control" placeholder="Numero...">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="fecha">Fecha</label>
			<input type="date" name="fecha" id="fecha" required class="form-control" placeholder="Fecha...">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="descuento">Descuento</label>
			<input type="number" disabled name="descuento" id="descuento" class="form-control" placeholder="Descuento"></input>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="credito">Crédito</label>
			<input type="number" disabled name="credito" id="credito" class="form-control" placeholder="Credito"></input>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="vencimiento">Vencimiento</label>
			<input type="date" name="vencimiento" id="vencimiento" required class="form-control" placeholder="Vencimiento...">
		</div>
	</div>
</div>
<div class="row">	
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-log-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label>Producto</label>
					<select name="pidproducto" class="form-control selectpicker" id="pidproducto" data-live-search="true" title="Elija un Producto..." data-size="7">
						@foreach($productos as $producto)
						<option value="{{$producto->idproducto}}_{{$producto->stockactual}}_{{$producto->precio}}">{{$producto->producto}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-log-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					<label for="cantidad">Cantidad</label>
					<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad..."></input>
				</div>
			</div>
			<div class="col-log-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					<label for="stockactual">Stock</label>
					<input type="number" disabled name="pstockactual" id="pstockactual" class="form-control" placeholder="Stock..."></input>
				</div>
			</div>
			<div class="col-log-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					<label for="preciounitario">Precio</label>
					<input type="number" name="ppreciounitario" id="ppreciounitario" class="form-control" placeholder="Precio..."></input>
				</div>
			</div>
			<div class="col-log-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					<label for="descuento">Descuento</label>
					<input type="number" name="pdescuento" id="pdescuento" class="form-control" placeholder="Descuento..."></input>
				</div>
			</div>
			<div class="col-log-1 col-md-1 col-sm-1 col-xs-12">
				<div class="form-group">
					<button type="button" id="bt-add" class="btn btn-primary">Agregar</button>
				</div>
			</div>

			<div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
				<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">
						<th>Opciones</th>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Descuento</th>
						<th>Subtotal</th>
					</thead>
					<tfoot>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><h4>TOTAL</h4></th>
						<th><h4 id="total">$      0</h4><input type="hidden" name="totalventa" id="totalventa"></th>
					</tfoot>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
		<div class="form-group">
			<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
			<button class="btn btn-primary" type="Submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>
</div>
		
{!!Form::close()!!}

@push('scripts')
<script>
	$(document).ready(function()
	{
		$("#bt-add").click(function()
		{
			agregar();
		});
	});

	var cont=0;

	total=0;
	subtotal=[];
	$("#guardar").hide();
	$("#pidproducto").change(mostrarValores);
	$("#cliente").change(cargarValores);
	$("#fecha").change(calcularVcto);

	function mostrarValores()
	{
		datosProducto=document.getElementById('pidproducto').value.split('_');
		$("#ppreciounitario").val(datosProducto[2]);
		$("#pstockactual").val(datosProducto[1]);

		unitario=datosProducto[2];
		descto=$("#descuento").val();
		rebaja=(unitario*descto)/100;
		$("#pdescuento").val(rebaja);
	}

	function cargarValores()
	{
		datosCliente=document.getElementById('cliente').value.split('_');
		$("#descuento").val(datosCliente[1]);
		$("#credito").val(datosCliente[2]);
		$("#idcliente").val(datosCliente[0]);
	}

	function calcularVcto()
	{
		var fecha = new Date($('#fecha').val());
		var dias=parseInt($('#credito').val());
		
		if (dias>0){
			dias=dias+1;
  			fecha.setDate(fecha.getDate()+dias);
  		}else{
  			fecha.setDate(fecha.getDate()+1);
  		}
  		
  		fecha=fecha.toLocaleDateString();

  		dia = fecha.substring(0,2);
  		mes = fecha.substring(3,5);
  		año = fecha.substring(6,10);

  		fecha2=año+"-"+mes+"-"+dia;

  		$('#vencimiento').val(fecha2);
 
	}

	
	function agregar()
	{
		datosProducto=document.getElementById('pidproducto').value.split('_');
		idproducto=datosProducto[0];
		producto=$("#pidproducto option:selected").text();
		cantidad=parseFloat($("#pcantidad").val());
		descuento=$("#pdescuento").val();
		preciounitario=$("#ppreciounitario").val();
		stock=parseFloat($("#pstockactual").val());

		if ( idproducto != ""  )
		{
			//if(stock>=cantidad)
			//{
				subtotal[cont]=(cantidad*(preciounitario-descuento));
				total=total+subtotal[cont];
				var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn-xs btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="preciounitario[]" value="'+preciounitario+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
				cont++;
			
				$("#total").html("$   "+total);
				$("#totalventa").val(total);
				$("#detalles").append(fila);
				limpiar();
				evaluar();
			//}
			//else
			//{
			//	alert("La cantidad "+cantidad+" a vender supera el stock "+stock);
			//}
		}
		else
		{
			alert("Error al ingresar el detalle de venta, revise los datos ingresados");
		}
	}

	function limpiar()
	{
		$("#pcantidad").val("");
		$("#ppreciounitario").val("");
		$("#pdescuento").val("");
		$("#pstockactual").val("");
	}

	function evaluar()
	{
		if (total>0)
		{
			$("#guardar").show();
		}
		else
		{
			$("#guardar").hide();
		}
	}

	function eliminar(index)
	{
		total=total-subtotal[index];
		$("#total").html("$ "+total);
		$("#totalventa").val(total);
		$("#fila"+index).remove();
		evaluar();
	}
</script>
@endpush
@endsection