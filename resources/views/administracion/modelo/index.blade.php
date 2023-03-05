@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Modelos <a href="modelo/create"><button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp&nbspAgregar Modelo</button></a></h3>
		@include('administracion.modelo.search')
	</div>
</div>
	
<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-10 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th class="text-center" width="10%">ID</th>
						<th class="text-center" width="60%">Nombre</th>
						<th class="text-center" width="10%">Estado</th>	
						<th class="text-center" width="20%">Acciones</th>
					</thead>
					@foreach($modelos as $modelo)
					<tr>
						<td class="text-center">{{$modelo->id}}</td>
						<td>{{$modelo->nombre}}</td>					
						@if($modelo->condicion)
							<td class="text-center">Activo</td>
						@else
							<td class="text-center">Inactivo</td>
						@endif
						<td class="text-center">							
							@if($modelo->condicion)
								<a href="{{URL::action('ModeloController@edit',$modelo->id)}}"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button></a>							
								<a href="" data-target="#modal-delete-{{$modelo->id}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button></a>							
							@else
								<button class="btn btn-xs btn-warning" disabled><i class="fa fa-pencil"></i></button>
								<a href="" data-target="#modal-delete-{{$modelo->id}}" data-toggle="modal"><button class="btn btn-xs btn-success"><i class="fa fa-check"></i></button></a>							
							@endif
						</td>
					</tr>
					@include('administracion.modelo.modal')
					@endforeach
				</table>
			</div>
		
		<p>{{$modelos->total()}} registros en total | Página {{$modelos->CurrentPage()}} de {{$modelos->LastPage()}}</p>
		
		{!! $modelos->appends(['searchText' => $searchText])->links() !!}

		</div>
	</div>
	
@endsection