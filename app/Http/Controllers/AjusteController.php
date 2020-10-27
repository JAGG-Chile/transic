<?php

namespace qbrema\Http\Controllers;

use Illuminate\Http\Request;

use qbrema\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use qbrema\Http\Requests\AjusteFormRequest;
//use qbrema\Ajustes;
//use qbrema\DetalleCompras;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class AjusteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index(Request $Request)
    {
    	if ($Request)
    	{
    		$query=trim($Request->get('searchText'));
    		$ajustes=DB::table('ajustes as a')
    		->select('a.idajustes',DB::raw('DATE_FORMAT(a.fecha, "%d-%m-%Y") as fecha'),'a.glosa','a.movto','a.cantidad')
    		->where('a.glosa','LIKE','%'.$query.'%')
            ->orwhere('a.idajustes','LIKE','%'.$query.'%')
    		->orderBy('a.fecha','desc')
    		->groupBy('a.idajustes','a.fecha','a.glosa','a.movto')
    		->paginate(7);
    		return view('almacen.ajustes.index',['ajustes'=>$ajustes,'searchText'=>$query]);
    	}
    }

    public function create()
    {
    	$productos=DB::table('productos as prod')
    	->select(DB::raw('CONCAT(prod.idproducto," ",prod.nombre) as producto'),'prod.idproducto')
    	->where('prod.estado','=','Activo')
    	->orderBy('nombre','asc')
    	->get();

    	return view('almacen.ajustes.create',['productos'=>$productos]);
    }

    public function store(AjusteFormRequest $request)
    {
    	try
    	{
    		DB::beginTransaction();
    		$ajuste=new Ajustes;
    		$ajuste->fecha=$request->get('fecha');
    		$ajuste->idproducto=$request->get('idproducto');
    		$ajuste->glosa=$request->get('glosa');
    		$ajuste->movto=$request->get('movto');
    		$ajuste->cantidad=$request->get('cantidad');
    		$compra->save();
    		DB::commit();
    	}
    	catch(Exception $e)
    	{
    		DB::rollback();
    	}

    	return Redirect::to('almacen/ajustes');
    }

    public function show($id)
    {
    	$ajuste=DB::table('ajustes as a')
    		->join('productos as p','a.idproducto','=','p.idproducto')
    		->select('a.idajustes',DB::raw('DATE_FORMAT(a.fecha, "%d-%m-%Y") as fecha'),'a.idproducto','p.nombre','a.glosa','a.movto','a.cantidad')
    		->where('a.idajustes','=',$id)
            ->groupBy('a.idajustes')
    		->first();
    		
    	return view('almacen.ajustes.show',['compra'=>$compra]);

    }

    public function destroy($id)
    {
    	$ajuste=Ajustes::findorFail($id);
    	$ajuste->estado="Anulada";
    	$ajuste->update();
    	return Redirect::to('almacen/ajustes'); 
    }

}