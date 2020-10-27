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
              <td>Listado de Categorias</td>
              <td><a href="crear_reporte_categorias/1" target="_blank" ><button class="btn btn-primary btn-xs">   Ver   </button></a> <a href="crear_reporte_categorias/2" target="_blank" ><button class="btn btn-success btn-xs">Descargar</button></a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Inventario de Productos</td>
              <td><a href="crear_reporte_productos/1" target="_blank" ><button class="btn btn-primary btn-xs">   Ver   </button></a> <a href="crear_reporte_productos/2" target="_blank" ><button class="btn btn-success btn-xs">Descargar</button></a>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>Listado de Clientes</td>
              <td><a href="crear_reporte_clientes/1" target="_blank" ><button class="btn btn-primary btn-xs">   Ver   </button></a> <a href="crear_reporte_clientes/2" target="_blank" ><button class="btn btn-success btn-xs">Descargar</button></a>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>Listado de Proveedores</td>
              <td><a href="crear_reporte_proveedores/1" target="_blank" ><button class="btn btn-primary btn-xs">   Ver   </button></a> <a href="crear_reporte_proveedores/2" target="_blank" ><button class="btn btn-success btn-xs">Descargar</button></a>
              </td>
            </tr>
            <tr>
              <td>5</td>
              <td>Listado Cuentas por Cobrar General</td>
              <td><a href="crear_reporte_cuentasxcobrar_vcto/1" target="_blank" ><button class="btn btn-primary btn-xs">   Ver   </button></a> <a href="crear_reporte_cuentasxcobrar_vcto/2" target="_blank" ><button class="btn btn-success btn-xs">Descargar</button></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
      