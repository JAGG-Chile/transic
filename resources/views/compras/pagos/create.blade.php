@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nueva Compra</h3>
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
{!!Form::Open(array('url'=>'compras/compra','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="proveedor">Proveedor</label>
			<select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
				@foreach($personas as $persona)
				<option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Documento</label>
			<select name="tipodocumento" class="form-control">
				<option value="Factura">Factura</option>
				<option value="Boleta">Boleta</option>
				<option value="Ticket">Ticket</option>
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="numero">Numero</label>
			<input type="text" name="numero" required class="form-control" placeholder="Numero...">
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="fecha">Fecha</label>
			<input type="date" name="fecha" required class="form-control" placeholder="Fecha...">
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="vencimiento">Vencimiento</label>
			<input type="date" name="vencimiento" required class="form-control" placeholder="Vencimiento...">
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="carpeta">Carpeta</label>
			<input type="text" name="carpeta" class="form-control">
		</div>
	</div>
</div>
<div class="row">	
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-log-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label>Producto</label>
					<select name="pidproducto" class="form-control selectpicker" id="pidproducto" data-live-search="true">
						@foreach($productos as $producto)
						<option value="{{$producto->idproducto}}">{{$producto->producto}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-log-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label for="cantidad">Cantidad</label>
					<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad..."></input>
				</div>
			</div>
			<div class="col-log-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label for="preciounitario">Precio</label>
					<input type="number" name="ppreciounitario" id="ppreciounitario" class="form-control" placeholder="Precio..."></input>
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
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Subtotal</th>
					</thead>
					<tfoot>
						<th>TOTAL</th>
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

	function agregar()
	{
		idproducto=$("#pidproducto").val();
		producto=$("#pidproducto option:selected").text();
		cantidad=$("#pcantidad").val();
		preciounitario=$("#ppreciounitario").val();

		if (idproducto!="" && cantidad!="" && cantidad>0 && preciounitario!="")
		{
			subtotal[cont]=(cantidad*preciounitario);
			total=total+subtotal[cont];
			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="preciounitario[]" value="'+preciounitario+'"></td><td>'+subtotal[cont]+'</td></tr>';
			cont++;
			
			$("#total").html("$ "+ total);
			
			$("#detalles").append(fila);
			limpiar();
			evaluar();
		}
		else
		{
			alert("Error al ingresar el detalle de compra, revise los datos ingresados");
		}
	}

	function limpiar()
	{
		$("#pcantidad").val("");
		$("#ppreciounitario").val("");
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