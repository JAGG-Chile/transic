{!!Form::Open(array('url'=>'administracion/modelo','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class='form-group'>
	<div class='input-group'>
		<input type="text" class="form-control" name="searchText" placeholder="Ingrese nombre de modelo" value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp&nbspBuscar</button>
		</span>
	</div>
</div>
{{Form::Close()}}