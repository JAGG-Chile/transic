<?php

namespace Transic\Http\Controllers;

use Illuminate\Http\Request;
use Transic\Productos;
use Illuminate\Support\Facades\Redirect;
use Transic\Http\Requests\ProductoFormRequest;
use DB;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
 /*    public function consulta()
    {
        $personas=DB::table('personas')
        ->where('tipopersona','=','Cliente')
        ->get();

        $productos=DB::table('productos as prod')
        ->select(DB::raw('CONCAT(prod.idproducto," ",prod.nombre) as producto'),'prod.idproducto','prod.stockactual','prod.precio')
        ->where('prod.estado','=','Activo')
        ->get();

        return view('pdf.consulta_productos',['personas'=>$personas,'productos'=>$productos]);
    }
    
    public function ver()
    {

        $productos=DB::table('productos as prod')
        ->select(DB::raw('CONCAT(prod.idproducto," ",prod.nombre) as producto'),'prod.idproducto','prod.nombre')
        ->where('prod.estado','=','Activo')
        ->get();

        return view('pdf.consulta_ctactexproducto',['productos'=>$productos]);
    } */
    
    public function index(Request $Request)
    {
    	if ($Request)
    	{
    		$query=trim($Request->get('searchText'));
    		$articulos=DB::table('articulos as a')
    		->join('marcas as mrc','a.id_marca','=','mrc.id')
            ->join('modelos as mdl','mdl.id','=','a.id_modelo')
            ->join('proveedores as p','p.id','=','a.id_proveedor')
    		->select('a.id','a.nombre','a.id_marca','mrc.nombre as nombreMarca','a.id_modelo','mdl.nombre as nombreModelo','a.id_proveedor','p.nombre as nombreProveedor',
                     'a.stockMinimo','a.stockActual','a.unidadMedida','a.saldoInicial','a.condicion')
    		->where('a.nombre','LIKE','%'.$query.'%')    		    		
    		->orderBy('a.nombre','ASC')
    		->paginate(7);
    		return view('administracion.producto.index',["articulos"=>$articulos,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	$marcas=DB::table('marcas')
        ->where('condicion','=',true)
        ->orderBy('nombre','asc')
        ->get();

        $modelos=DB::table('modelos')
        ->where('condicion','=',true)
        ->orderBy('nombre','asc')
        ->get();

        
        $proveedores=DB::table('proveedores')
        ->where('condicion','=',true)
        ->orderBy('nombre','asc')
        ->get();

    	return view("administracion.producto.create",["marcas"=>$marcas,
                                                       "modelos"=>$modelos,
                                                       "proveedores"=>$proveedores]);
    }

    public function store(ProductoFormRequest $Request)
    {
    	$articulo = new Productos;

    	$articulo->nombre       = strtoupper($Request->get('nombre'));
    	$articulo->id_proveedor = $Request->get('idProveedor');    	
        $articulo->id_marca     = $Request->get('idMarca');    	
        $articulo->id_modelo    = $Request->get('idModelo');
    	$articulo->stockMinimo  = $Request->get('stockMinimo');
    	$articulo->unidadMedida = $Request->get('unidadMedida');
        $articulo->saldoInicial = $Request->get('saldoInicial');
    	$articulo->condicion    = 1;
    	
    	$articulo->save();

    	return Redirect::to('administracion/producto');      	
    }

    public function show(request $Request)
    {	  
       //
    }

    public function edit($id)
    {
    	$articulo=Productos::findorFail($id);
		$marcas=DB::table('marcas')->get();
        $modelos=DB::table('modelos')->get();
        $proveedores=DB::table('proveedores')->get();

    	return view("administracion.producto.edit",["articulo"=>$articulo,
                                                    "marcas"=>$marcas,
                                                    "modelos"=>$modelos,
                                                    "proveedores"=>$proveedores]);
    }

    public function update(ProductoFormRequest $Request, $id)
    {
    	
        $articulo=Productos::findorFail($id);

        $articulo->nombre       = strtoupper($Request->get('nombre'));
    	$articulo->id_proveedor = $Request->get('idProveedor');    	
        $articulo->id_marca     = $Request->get('idMarca');    	
        $articulo->id_modelo    = $Request->get('idModelo');
    	$articulo->stockMinimo  = $Request->get('stockMinimo');
    	$articulo->unidadMedida = $Request->get('unidadMedida');
        //$articulo->saldoInicial = $Request->get('saldoInicial');    	
    	
    	$articulo->update();

    	return Redirect::to('administracion/producto');

    }

    public function destroy($id)
    {
    	$articulo = Productos::findorFail($id);

        if ($articulo->condicion){
            // activo
            $articulo->condicion=0;
        }else{
            $articulo->condicion=1;
        }
    	
    	$articulo->update();

    	return Redirect::to('administracion/producto'); 

    }
}
