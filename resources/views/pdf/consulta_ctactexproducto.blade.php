@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Cuenta Corriente por Producto</h3>
	</div>
</div>
	
{!!Form::Open(array('url'=>'resultado_ctactexproducto','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label for="cliente">Producto</label>
			<select name="idproducto" id="idproducto" class="form-control selectpicker" data-live-search="true" title="Elija un Producto..." data-size="5">
				@foreach($productos as $p)
				<option value="{{$p->idproducto}}">{{$p->nombre}}</option>
				@endforeach
			</select>
		</div>
		
	    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		    <button class="btn btn-success" type="submit" target='_blank'>Buscar</button></a>
	    </div>
	</div>
	
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label for="desde">Desde</label>
			<input type="date" name="desde" required class="form-control" placeholder="Desde...">
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label for="hasta">Hasta</label>
			<input type="date" name="hasta" required class="form-control" placeholder="hasta...">
		</div>
	</div>

</div>
{!!Form::close()!!}

@endsection