@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <h3>Listado de Reportes</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>#</th>
            <th>Nombre</th>
            <th>Opciones</th>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Reporte de Categorias</td>
              <td><a href="crear_reporte_categorias/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
              <td><a href="crear_reporte_categorias/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
      