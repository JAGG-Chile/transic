<?php

namespace Transic\Http\Controllers;

use Illuminate\Http\Request;
use Transic\Categorias;
use Transic\Ventas;
use Transic\DetalleVentas;
use Transic\Productos;
use Transic\Personas;
use Illuminate\Support\Facades\Redirect;
use Transic\Http\Requests\CategoriaFormRequest;
use Transic\Http\Requests\VentaFormRequest;
use DB;


class PdfController extends Controller
{
   
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("pdf.listado_reportes");
    }


      public function crearPDF($datos,$vistaurl,$tipo,$fechai,$fechat,$formato)
    {

        $data = $datos;
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $date = $date->format('d-m-Y');
        $desde= $fechai;
        $hasta= $fechat;
        $view =  \View::make($vistaurl, compact('data', 'date','desde','hasta'))->render();
        $pdf = \App::make('dompdf.wrapper');
        if($formato==1){
        $pdf->loadHTML($view)->setPaper('letter', 'portrait');
        }
        if($formato==2){
        $pdf->loadHTML($view)->setPaper('folio', 'landscape');
        }
        if($tipo==1){return $pdf->stream('reporte');}
        if($tipo==2){return $pdf->download('reporte.pdf');}
    }


    public function crear_reporte_categorias($tipo)
    {

     $vistaurl="pdf.reporte_por_categorias";
     $categorias=DB::table('categorias')
     ->where('condicion','1')
     ->orderBy('idcategoria','asc')
     ->get();
     
     return $this->crearPDF($categorias, $vistaurl,$tipo);

    }

    public function crear_reporte_productos($tipo)
    {

     $vistaurl="pdf.reporte_por_productos";
     $productos=DB::table('productos')
        ->join('personas','productos.idproveedor','=','personas.idpersona')
        ->join('categorias','productos.idcategoria','=','categorias.idcategoria')
        ->where('productos.estado','=','Activo')
        ->select('categorias.nombre as categoria','personas.nombre as proveedor','productos.idproducto','productos.nombre','productos.precio','productos.stockactual')
        ->orderBy('proveedor','ASC')
        ->orderBy('productos.nombre','ASC')
        ->get();

     return $this->crearPDF($productos,$vistaurl,$tipo,"","");

    }
    
    public function crear_reporte_clientes($tipo)
    {

     $vistaurl="pdf.reporte_por_clientes";
     $clientes=DB::table('personas')
        ->where('personas.tipopersona','=','Cliente')
        ->select('personas.nombre','personas.rut','personas.contacto','personas.telefono','personas.email')
        ->orderBy('personas.nombre','ASC')
        ->get();

     return $this->crearPDF($clientes,$vistaurl,$tipo);

    }

    public function crear_reporte_proveedores($tipo)
    {

     $vistaurl="pdf.reporte_por_proveedores";
     $proveedores=DB::table('personas')
        ->where('personas.tipopersona','=','Proveedor')
        ->select('personas.nombre','personas.rut','personas.contacto','personas.telefono','personas.email')
        ->orderBy('personas.nombre','ASC')
        ->get();

     return $this->crearPDF($proveedores,$vistaurl,$tipo);

    }

    public function crear_reporte_cuentasxcobrar($id)
    {
         $vistaurl="pdf.reporte_por_cuentasxcobrar";
         $cliente=$id;
         
         $tipo="1";

         $ventas=DB::table('ventas')
            ->join('personas', 'personas.idpersona', '=', 'ventas.idcliente')
            ->where('ventas.estado', '=', 'Pendiente')
            ->where('ventas.idcliente','=',$cliente)
            ->select('ventas.vencimiento','ventas.fecha','ventas.tipodocumento','ventas.numero','ventas.idcliente','personas.nombre','ventas.totalventa')
            ->Orderby('ventas.vencimiento','ASC')
            ->get();

        return $this->crearPDF($ventas, $vistaurl,$tipo,"","");

    }

    public function crear_reporte_cuentasxcobrar_vcto($tipo)
    {
         $vistaurl="pdf.reporte_por_cuentasxcobrar_vcto";


         $ventas=DB::table('ventas')
            ->join('personas', 'ventas.idcliente', '=', 'personas.idpersona')
            ->where('ventas.estado', '=', 'Pendiente')
            ->select('ventas.vencimiento','ventas.fecha','ventas.tipodocumento','ventas.numero','ventas.idcliente','personas.nombre','ventas.totalventa')
            ->Orderby('ventas.vencimiento','ASC')
            ->Orderby('personas.nombre','ASC')
            ->get();

        return $this->crearPDF($ventas, $vistaurl,$tipo);

    }

    public function crear_reporte_cuentasxcobrar_producto($id)
    {
         $vistaurl="pdf.reporte_por_cuentasxcobrar_producto";

         $tipo="1";
         $producto=$id;

         $ventas=DB::table('detalle_ventas')
            ->join('ventas', 'detalle_ventas.idventa', '=', 'ventas.idventa')
            ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
            ->join('personas','ventas.idcliente','=','personas.idpersona')
            ->where('detalle_ventas.idproducto','=',$producto)
            ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre as cliente','detalle_ventas.idproducto','productos.nombre','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
            ->Orderby('cliente','ASC')
            ->get();

        return $this->crearPDF($ventas, $vistaurl,$tipo);

    }

    public function crear_reporte_ventasxcliente($id)
    {
         $vistaurl="pdf.reporte_por_ventasxcliente";
         $tipo="1";
         $cliente=$id;

         $ventas=DB::table('ventas')
            ->join('personas','ventas.idcliente','=','personas.idpersona')
            ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
            ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
            ->where('ventas.idcliente','=',$cliente)
            ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
            ->Orderby('producto','ASC')
            ->get();

        return $this->crearPDF($ventas, $vistaurl,$tipo);

    }

    public function resultado_consulta_ventas(Request $request)
    {
         $vistaurl="pdf.reporte_por_ventasxcliente";
         $tipo="1";
         $cliente=$request->input('idcliente');
         $producto=$request->input('idproducto');
         $estado=$request->input('estado');
         $desde=$request->input('desde');
         $hasta=$request->input('hasta');

         //Todos los estados
         
         if ($estado=="Todos")
         {
            if ($producto=="")
            {
                $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where('ventas.idcliente','=',$cliente)
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
            }else{
                $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where('ventas.idcliente','=',$cliente)
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->where('productos.idproducto','=',$producto)
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
            }
         }

        if ($estado=="Pendiente")
         {
            if ($producto=="")
            {
                $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where([['ventas.idcliente','=',$cliente],['ventas.estado','=','Pendiente']])
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
            }else{
                $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where([['ventas.idcliente','=',$cliente],['ventas.estado','=','Pendiente']])
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->where('productos.idproducto','=',$producto)
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
            }
         }

         if ($estado=="Cancelada")
         {
            if ($producto=="")
            {
                $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where([['ventas.idcliente','=',$cliente],['ventas.estado','=','Cancelada']])
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
            }else{
                 $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where([['ventas.idcliente','=',$cliente],['ventas.estado','=','Cancelada']])
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->where('productos.idproducto','=',$producto)
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
            }
         }

         if ($estado=="Anulada")
         {
            if ($producto=="")
            {
                $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where([['ventas.idcliente','=',$cliente],['ventas.estado','=','Anulada']])
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
            }else{
                 $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where([['ventas.idcliente','=',$cliente],['ventas.estado','=','Anulada']])
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->where('productos.idproducto','=',$producto)
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre','detalle_ventas.idproducto','productos.nombre as producto','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
            }
         }
         
         return $this->crearPDF($ventas, $vistaurl,$tipo,$desde,$hasta,2);
    }

    public function resultado_consulta_productos(Request $request)
    {
         $vistaurl="pdf.reporte_por_ventasxproducto";
         $tipo="1";
         $cliente=$request->input('idcliente');
         $producto=$request->input('idproducto');
         $desde=$request->input('desde');
         $hasta=$request->input('hasta');

         //Todos los clientes
         
         if ($cliente=="")
         {
                $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where('productos.idproducto','=',$producto)
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre as cliente','detalle_ventas.idproducto','productos.nombre','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->orderBy('cliente','ASC')
                ->orderBy('ventas.fecha','ASC')
                ->get();
         }else{

            // para un cliente

                $ventas=DB::table('ventas')
                ->join('personas','ventas.idcliente','=','personas.idpersona')
                ->join('detalle_ventas', 'detalle_ventas.idventa','=','ventas.idventa')
                ->join('productos','detalle_ventas.idproducto','=','productos.idproducto')
                ->where('ventas.idcliente','=',$cliente)
                ->whereBetween('ventas.fecha', [$desde, $hasta])
                ->where('productos.idproducto','=',$producto)
                ->select('ventas.fecha','ventas.tipodocumento','ventas.numero','personas.nombre as cliente','detalle_ventas.idproducto','productos.nombre','detalle_ventas.cantidad','detalle_ventas.preciounitario','detalle_ventas.descuento')
                ->Orderby('ventas.fecha','ASC')
                ->get();
         }

         return $this->crearPDF($ventas, $vistaurl,$tipo,$desde,$hasta,2);
    }
    
    public function resultado_deuda_cliente(Request $request)
    {
        $vistaurl="pdf.reporte_por_cuentasxcobrar";
         $tipo="1";
         $cliente=$request->input('idcliente');
         $desde=$request->input('desde');
         $hasta=$request->input('hasta');

        // para un cliente

         $ventas=DB::table('ventas')
            ->join('personas', 'personas.idpersona', '=', 'ventas.idcliente')
            ->where('ventas.estado', '=', 'Pendiente')
            ->where('ventas.idcliente','=',$cliente)
            ->whereBetween('ventas.fecha', [$desde, $hasta])
            ->select('ventas.vencimiento','ventas.fecha','ventas.tipodocumento','ventas.numero','ventas.idcliente','personas.nombre','ventas.totalventa')
            ->Orderby('ventas.vencimiento','ASC')
            ->get();
            
         return $this->crearPDF($ventas, $vistaurl,$tipo,$desde,$hasta);
    }
    
    
    public function resultado_ctactexproducto(Request $Request)
    {               
        $idproducto=$Request->get('idproducto');
        $desde=$Request->get('desde');
        $hasta=$Request->get('hasta');
        
        $uno=DB::table('detalle_ventas as dv')
            ->join('ventas','ventas.idventa','=','dv.idventa')
            ->join('personas','ventas.idcliente','=','personas.idpersona')
            ->join('productos','dv.idproducto','=','productos.idproducto')
            ->select('ventas.fecha',DB::raw('CONCAT("V",ventas.numero) as documento'),'personas.nombre','productos.nombre as prod','dv.cantidad')
            ->where('dv.idproducto','=',$idproducto)
            ->whereBetween('ventas.fecha', [$desde, $hasta])
            ->orderBy('ventas.fecha','ASC');

        $dos=DB::table('detalle_compras as dc')
            ->join('compras','compras.idcompra','=','dc.idcompra')
            ->join('personas','compras.idproveedor','=','personas.idpersona')
            ->join('productos','dc.idproducto','=','productos.idproducto')
            ->select('compras.fecha',DB::raw('CONCAT("C",compras.numero) as documento'),'personas.nombre','productos.nombre as prod','dc.cantidad')
            ->where('dc.idproducto','=',$idproducto)
            ->whereBetween('compras.fecha', [$desde, $hasta])
            ->orderBy('compras.fecha','ASC')
            ->union($uno)
            ->get();
            
        $vistaurl='pdf.reporte_por_ctactexproducto';
        $tipo='1';

        return $this->crearPDF($dos, $vistaurl,$tipo,$desde,$hasta);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
