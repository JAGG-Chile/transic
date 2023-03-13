<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transic 1.0</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="/home" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>TR</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Transic Ltda</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  
                  <span class="hidden-xs">{{auth()->user()->name }}</span>
                  <small class="bg-red">Online</small>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  {{-- <li class="user-header">
                    
                    <p>
                      Juan Garcìa - Desarrollo de Software
                      <small>https://juan-garcia.cl</small>
                    </p> 
                  </li> --}}
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Administración</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
               <ul class="treeview-menu">
                {{--
                <li><a href="{{url('almacen/producto')}}"><i class="fa fa-circle-o"></i> Compras</a></li>
                <li><a href="{{url('almacen/categoria')}}""><i class="fa fa-circle-o"></i> Articulos</a></li>
                <li><a href="{{url('almacen/categoria')}}""><i class="fa fa-circle-o"></i> Vehiculos</a></li>
                <li><a href="{{url('almacen/categoria')}}""><i class="fa fa-circle-o"></i> Proveedores</a></li>
                <li><a href="{{url('almacen/categoria')}}""><i class="fa fa-circle-o"></i> Marcas</a></li>
                <li><a href="{{url('almacen/categoria')}}""><i class="fa fa-circle-o"></i> Modelos</a></li>
                --}}
                <li><a href="#"><i class="fa fa-circle-o"></i> Compras</a></li>
                <li><a href="{{url('administracion/producto')}}"><i class="fa fa-circle-o"></i> Articulos</a></li>
                <li><a href="{{url('administracion/vehiculo')}}"><i class="fa fa-circle-o"></i> Vehiculos</a></li>
                <li><a href="{{url('administracion/proveedor')}}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                <li><a href="{{url('administracion/marca')}}"><i class="fa fa-circle-o"></i> Marcas</a></li>
                <li><a href="{{url('administracion/modelo')}}"><i class="fa fa-circle-o"></i> Modelos</a></li>
              </ul> 

            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-wrench"></i>
                <span>Mantenciones</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                {{-- 
                <li><a href="{{url('compras/compra')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="{{url('compras/proveedor')}}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                <li><a href="{{url('compras/pagos')}}"><i class="fa fa-circle-o"></i> Pagos</a></li>
                 --}}
                 <li><a href="#"><i class="fa fa-circle-o"></i> Ingresar Mantenimiento</a></li>
              </ul>

            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-truck"></i>
                <span>Hoja de Ruta</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                {{-- <li><a href="{{url('ventas/venta')}}"><i class="fa fa-circle-o"></i> Iniciar Vuelta</a></li>
                <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-circle-o"></i> Ingresar Recarga</a></li>
                <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-circle-o"></i> Finalizar Vuelta</a></li> --}}
                <li><a href="#"><i class="fa fa-circle-o"></i> Iniciar Vuelta</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Ingresar Recarga</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Finalizar Vuelta</a></li>
              </ul>
            </li>
                     
            <li class="treeview">
              <a href="#">
                <i class="fa fa-print"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">                
                {{-- <li><a href="{{url('consulta_ventas')}}"><i class="fa fa-circle-o"></i> Ventas por Cliente</a></li>
                <li><a href="{{url('consulta_productos')}}"><i class="fa fa-circle-o"></i> Ventas por Producto</a></li>
                <li><a href="{{url('consulta_deudaxcliente')}}"><i class="fa fa-circle-o"></i> Deuda por Cliente</a></li>
                <li><a href="{{url('consulta_ctactexproducto')}}"><i class="fa fa-circle-o"></i> Cta.Cte. por Producto</a></li>
                <li><a href="{{url('pdf')}}"><i class="fa fa-circle-o"></i> Otros Reportes</a></li>  --}}
              </ul>
            </li>  

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Control de Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-circle-o"></i> Mantención de Usuarios</a></li>                
              </ul>
            </li>
             <li>
             <a href="#">
                <i class="fa fa-book"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema Transic Ltda.</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
                          
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Desarrollado por <a href="http://juan-garcia.cl" target="_blank">www.juan-garcia.cl</a>.</strong> para Transic Ltda. &copy All rights reserved.
      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>

    <!-- javascript del sistema laravel -->
<!--    <script src="{{asset('js/sistemalaravel.js')}}"></script>

   <script>cargarlistado(1);</script>
 -->
    
  </body>
</html>
