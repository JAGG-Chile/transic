<?php

namespace Transic\Http\Controllers;

use Illuminate\Http\Request;

use Transic\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Transic\Http\Requests\VentaFormRequest;
use Transic\Ventas;
use Transic\DetalleVentas;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function consulta()
    {
        $personas=DB::table('personas')
        ->where('tipopersona','=','Cliente')
        ->get();

        $productos=DB::table('productos as prod')
        ->select(DB::raw('CONCAT(prod.idproducto," ",prod.nombre) as producto'),'prod.idproducto','prod.stockactual','prod.precio')
        ->where('prod.estado','=','Activo')
        ->get();

        return view('pdf.consulta_ventas',['personas'=>$personas,'productos'=>$productos]);
    }

    public function index(Request $Request)
    {
    	if ($Request)
    	{
    		$query=trim($Request->get('searchText'));
    		$ventas=DB::table('ventas as v')
    		->join('personas as p','v.idcliente','=','p.idpersona')
    		->join('detalle_ventas as dv','v.idventa','=','dv.idventa')
    		->select('v.idventa',DB::raw('DATE_FORMAT(v.fecha, "%d-%m-%Y") as fecha'),DB::raw('DATE_FORMAT(v.vencimiento, "%d-%m-%Y") as vencimiento'),'p.nombre','p.descuento','v.tipodocumento','v.numero','v.pago','v.estado','v.totalventa')
    		->where('v.numero','LIKE','%'.$query.'%')
            ->orwhere('p.nombre','LIKE','%'.$query.'%')
    		->orderBy('v.fecha','desc')
    		->groupBy('v.idventa','v.fecha','v.vencimiento','p.nombre','p.descuento','v.tipodocumento','v.numero','v.pago','v.estado','v.totalventa')
    		->paginate(7);
    		return view('ventas.venta.index',['ventas'=>$ventas,'searchText'=>$query]);
    	}
    }

    public function create()
    {
    	$personas=DB::table('personas')
        ->where('tipopersona','=','Cliente')
        ->orderBy('nombre','asc')
        ->get();

    	$productos=DB::table('productos as prod')
    	->select(DB::raw('CONCAT(prod.idproducto," ",prod.nombre) as producto'),'prod.idproducto','prod.stockactual','prod.precio')
    	->where('prod.estado','=','Activo')
    	->orderBy('nombre','asc')
    	->get();

    	return view('ventas.venta.create',['personas'=>$personas,'productos'=>$productos]);
    }

    public function store(VentaFormRequest $request)
    {
    	try
    	{
    		DB::beginTransaction();
    		$venta=new Ventas;
    		$venta->idcliente=$request->get('idcliente');
    		$venta->tipodocumento=$request->get('tipodocumento');
    		$venta->numero=$request->get('numero');
    		$venta->fecha=$request->get('fecha');
    		$venta->vencimiento=$request->get('vencimiento');
    		$venta->pago=$request->get('pago');
    		$venta->impuesto='19';
            $venta->totalventa=$request->get('totalventa');
    		$venta->estado='Pendiente';
			$venta->save();

    		$idproducto=$request->get('idproducto');
    		$cantidad=$request->get('cantidad');
    		$preciounitario=$request->get('preciounitario');
            $descuento=$request->get('descuento');

    		$cont=0;

    		while($cont < count($idproducto))
    		{
    			$detalle=new DetalleVentas;
    			$detalle->idventa=$venta->idventa;
    			$detalle->idproducto=$idproducto[$cont];
    			$detalle->cantidad=$cantidad[$cont];
    			$detalle->preciounitario=$preciounitario[$cont];
                $detalle->descuento=$descuento[$cont];
    			$detalle->save();
    			$cont=$cont+1;
    		}

    		DB::commit();
    	}
    	catch(Exception $e)
    	{
    		DB::rollback();
    	}

    	return Redirect::to('ventas/venta');
    }

    public function show($id)
    {
    	$venta=DB::table('ventas as v')
    		->join('personas as p','v.idcliente','=','p.idpersona')
    		->join('detalle_ventas as dv','v.idventa','=','dv.idventa')
    		->select('v.idventa',DB::raw('DATE_FORMAT(v.fecha, "%d-%m-%Y") as fecha'),DB::raw('DATE_FORMAT(v.vencimiento, "%d-%m-%Y") as vencimiento'),'p.nombre','v.tipodocumento','v.numero','v.pago','v.estado','v.totalventa')
    		->where('v.idventa','=',$id)
            ->groupBy('v.idventa','v.fecha','v.vencimiento','p.nombre','v.tipodocumento','v.numero','v.pago','v.estado','v.totalventa')
            ->first();

    	$detalle=DB::table('detalle_ventas as dv')
    		->join('productos as p','dv.idproducto','=','p.idproducto')
    		->select('p.idproducto','p.nombre as producto','dv.cantidad','dv.preciounitario','dv.descuento')
    		->where('dv.idventa','=',$id)
    		->get();

    	return view('ventas.venta.show',['venta'=>$venta,'detalle'=>$detalle]);

    }

    public function destroy($id)
    {
    	$venta=Ventas::findorFail($id);
    	$venta->estado="Anulada";
    	$venta->update();
    	return Redirect::to('ventas/venta'); 
    }
}
