@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Ingreso de Pagos</h3>
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
{!!Form::Open(array('url'=>'compras/pagos','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg- col-m3-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>N° Documento</label>
			<select name="numero" id="numero" class="form-control selectpicker" data-live-search="true" title="Ingrese N° Documento...">
				@foreach($documentos as $doc)
				<option value="{{$doc->numero}}_{{$doc->idcompra}}_{{$doc->fecha}}_{{$doc->totalcompra}}">{{$doc->numero}}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Fecha</label>
			<input type="text" name="fechadoc" id="fechadoc" disabled class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Id Compra</label>
			<input type="text" name="idcompra" id="idcompra" disabled class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Total Compra</label>
			<input type="text" name="totalcompra" id="totalcompra" disabled class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Total Abono</label>
			<input type="text" name="totalabono" id="totalabono" disabled class="form-control">
		</div>
	</div>
</div>


<div class="row">	
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-log-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label>Fecha</label>
					<input type="date" name="fecha" id="fecha" class="form-control"></input>
				</div>
			</div>
			<div class="col-log-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label>Forma de Pago</label>
					<select name="formapago" class="form-control selectpicker" id="formapago" data-live-search="true">
  						<option value="Efectivo" selected>Efectivo</option> 
  						<option value="Transferencia">Transferencia</option>
  						<option value="ChequeContado">Cheque al Día</option>
  						<option value="ChequeCredito">Cheque a Fecha</option>
					</select>
				</div>
			</div>
			<div class="col-log-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label>Tipo de Pago</label>
					<select name="tipopago" class="form-control selectpicker" id="tipopago" data-live-search="true">
  						<option value="Total" selected>Total</option> 
  						<option value="Abono">Abono</option>
					</select>
				</div>
			</div>
			<div class="col-log-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label>Detalle</label>
					<textarea name="detalle" id="detalle" rows="2" cols="40" placeholder="Escribe tus comentarios aquí..."></textarea>
				</div>
			</div>
			<div class="col-log-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label>Monto</label>
					<input type="number" name="monto" id="monto" class="form-control"></input>
				</div>
			</div>

			<div class="col-log-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					<button type="button" id="bt-add" class="btn btn-primary">Agregar</button>
				</div>
			</div>

			<div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
				<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">
						<th>Opciones</th>
						<th>Fecha</th>
						<th>FormaPago</th>
						<th>TipoPago</th>
						<th>Detalle</th>
						<th>Monto</th>
					</thead>
					<tfoot>
						<th>TOTAL</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><h4 id="total">$</h4></th>
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

	//$("#pidproducto").change(mostrarValores);
	$("#numero").change(cargarValores);
	//$("#fecha").change(calcularVcto);

	function cargarValores()
	{
		datosCompra=document.getElementById('numero').value.split('_');
		$("#idcompra").val(datosCompra[1]);
		$("#fechadoc").val(datosCompra[2]);
		$("#totalcompra").val(datosCompra[3]);
		
		id=$("#idcompra").val();
		$("#totalabono").val(id);
		
	}
	
	function agregar()
	{
		fecha=$("#fecha").val();
		formapago=$("#formapago option:selected").text();
		tipopago=$("#tipopago option:selected").text();
		detalle=$("#detalle").val();
		monto=$("#monto").val();

		if (fecha!="" && formapago!="" && tipopago!="" && monto > 0)
		{
			subtotal[cont]=parseInt(monto);
			total=total+subtotal[cont];
			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-xs btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="date" name="fecha[]" value="'+fecha+'">'+'</td><td><input type="text" name="formapago[]" value="'+formapago+'"></td><td><input type="text" name="tipopago[]" value="'+tipopago+'"></td><td><input type="text" name="detalle[]" value="'+detalle+'"></td><td><input type="number" name="monto[]" value="'+monto+'"></td></tr>';
			
			cont++;

			$("#total").html("$ "+ total);
			
			$("#detalles").append(fila);
			limpiar();
			evaluar();
		}
		else
		{
			alert("Error al ingresar el detalle de pago, revise los datos ingresados");
		}
	}

	function limpiar()
	{
		$("#fecha").val("");
		$("#monto").val("");
		$("#detalle").val("");
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
		$("#fila"+index).remove();
		evaluar();
	}
</script>
@endpush
@endsection