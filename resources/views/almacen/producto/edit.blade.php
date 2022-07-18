@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Producto: {{$productos->idproducto}} {{$productos->nombre}}</h3>
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
{!!Form::model($productos,['method'=>'PATCH','route'=>['almacen.producto.update',$productos->idproducto]])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" required value="{{$productos->nombre}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="descripcion">Descripción</label>
			<input type="text" name="descripcion" value="{{$productos->descripcion}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Categoría</label>
			<select name="idcategoria" class="form-control">
				@foreach ($categorias as $cat)
				@if ($cat->idcategoria==$productos->idcategoria)
				<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
				@else
				<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Proveedor</label>
			<select name='idproveedor' class="form-control">
				@foreach ($personas as $p)
				@if ($p->idpersona==$productos->idproveedor)
				<option value="{{$p->idpersona}}" selected>{{$p->nombre}}</option>
				@else
				<option value="{{$p->idpersona}}">{{$p->nombre}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="precio">Precio</label>
			<input type="number" name="precio" required value="{{$productos->precio}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="stockactual">Stock Actual</label>
			<input type="number" step="0.01" name="stockactual" required value="{{$productos->stockactual}}" class="form-control">
			
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="Tipo">Tipo Producto</label>
			<select name="tipo">
                    <option value="F">Final</option>
                    <option value="P">Preparado</option>
            </select>
		</div>
	</div>
	
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="ultinventariofecha">Ultimo Inventario Fecha</label>
			<input type="date" name="ultinventariofecha" class="form-control" placeholder="Fecha último inventario ...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="ultinventariostock">Ultimo Inventario Stock</label>
			<input type="number" step="0.01" name="ultinventariostock" class="form-control" placeholder="Stock último inventario ...">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<button class="btn btn-primary" type="Submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>
</div>
		
{!!Form::close()!!}

@endsection