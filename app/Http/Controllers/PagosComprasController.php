<?php

namespace qbrema\Http\Controllers;

use Illuminate\Http\Request;

use qbrema\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use qbrema\Http\Requests\PagosComprasFormRequest;
use qbrema\PagosCompras;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PagosComprasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$documentos=DB::table('compras')
        ->select('compras.numero','compras.idcompra',DB::raw('DATE_FORMAT(compras.fecha, "%d-%m-%Y") as fecha'),'compras.totalcompra')
        ->where('compras.estado','=','Pendiente')
        ->get();
        
        $pagos=DB::table('pagos_compras')
        ->select('pagos_compras.idcompra',DB::raw('sum(pagos_compras.monto) as abono'))
        ->groupBy('pagos_compras.idcompra')
        ->get();
        
    	$formapago=['Transferencia','Cheque Contado','Cheque a Fecha','Efectivo'];

    	return view('compras.pagos.index',['documentos'=>$documentos,'pagos'=>$pagos,'formapago'=>$formapago]);

    }

    // public function create()
    // {
    // 	$personas=DB::table('personas')
    //     ->where('tipopersona','=','Proveedor')
    //     ->get();

    // 	$productos=DB::table('productos as prod')
    // 	->select(DB::raw('CONCAT(prod.idproducto," ",prod.nombre) as producto'),'prod.idproducto')
    // 	->where('prod.estado','=','Activo')
    // 	->get();

    // 	return view('compras.compra.create',['personas'=>$personas,'productos'=>$productos]);
    // }

    // public function store(CompraFormRequest $request)
    // {
    // 	try
    // 	{
    // 		DB::beginTransaction();
    // 		$compra=new Compras;
    // 		$compra->idproveedor=$request->get('idproveedor');
    // 		$compra->tipodocumento=$request->get('tipodocumento');
    // 		$compra->numero=$request->get('numero');
    // 		$compra->fecha=$request->get('fecha');
    // 		$compra->vencimiento=$request->get('vencimiento');
    // 		$compra->carpeta=$request->get('carpeta');
    // 		$compra->impuesto='19';
    // 		$compra->estado='Pendiente';
    // 		$compra->save();

    // 		$idproducto=$request->get('idproducto');
    // 		$cantidad=$request->get('cantidad');
    // 		$preciounitario=$request->get('preciounitario');

    // 		$cont=0;

    // 		while($cont < count($idproducto))
    // 		{
    // 			$detalle=new DetalleCompras;
    // 			$detalle->idcompra=$compra->idcompra;
    // 			$detalle->idproducto=$idproducto[$cont];
    // 			$detalle->cantidad=$cantidad[$cont];
    // 			$detalle->preciounitario=$preciounitario[$cont];
    // 			$detalle->save();
    // 			$cont=$cont+1;
    // 		}

    // 		DB::commit();
    // 	}
    // 	catch(Exception $e)
    // 	{
    // 		DB::rollback();
    // 	}

    // 	return Redirect::to('compras/compra');
    // }

    // public function show($id)
    // {
    // 	$compra=DB::table('compras as c')
    // 		->join('personas as p','c.idproveedor','=','p.idpersona')
    // 		->join('detalle_compras as dc','c.idcompra','=','dc.idcompra')
    // 		->select('c.idcompra',DB::raw('DATE_FORMAT(c.fecha, "%d-%m-%Y") as fecha'),DB::raw('DATE_FORMAT(c.vencimiento, "%d-%m-%Y") as vencimiento'),'p.nombre','c.tipodocumento','c.numero','c.carpeta','c.estado',DB::raw('sum(dc.cantidad*dc.preciounitario) as total'))
    // 		->where('c.idcompra','=',$id)
    //         ->groupBy('c.idcompra','c.fecha','c.vencimiento','p.nombre','c.tipodocumento','c.numero','c.carpeta','c.estado')
    // 		->first();

    // 	$detalle=DB::table('detalle_compras as dc')
    // 		->join('productos as p','dc.idproducto','=','p.idproducto')
    // 		->select('p.nombre as producto','dc.cantidad','dc.preciounitario')
    // 		->where('dc.idcompra','=',$id)
    // 		->get();

    // 	return view('compras.compra.show',['compra'=>$compra,'detalle'=>$detalle]);

    // }

    // public function destroy($id)
    // {
    // 	$compra=Compras::findorFail($id);
    // 	$compra->estado="Anulada";
    // 	$compra->update();
    // 	return Redirect::to('compras/compra'); 
    // }

}
