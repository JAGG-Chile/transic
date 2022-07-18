<?php

namespace qbrema\Http\Controllers;

use Illuminate\Http\Request;
use qbrema\Productos;
use Illuminate\Support\Facades\Redirect;
use qbrema\Http\Requests\ProductoFormRequest;
use DB;

class ProductoController extends Controller
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

        return view('pdf.consulta_productos',['personas'=>$personas,'productos'=>$productos]);
    }
    
    public function ver()
    {

        $productos=DB::table('productos as prod')
        ->select(DB::raw('CONCAT(prod.idproducto," ",prod.nombre) as producto'),'prod.idproducto','prod.nombre')
        ->where('prod.estado','=','Activo')
        ->get();

        return view('pdf.consulta_ctactexproducto',['productos'=>$productos]);
    }
    
    public function index(Request $Request)
    {
    	if ($Request)
    	{
    		$query=trim($Request->get('searchText'));
    		$productos=DB::table('productos as p')
    		->join('personas as per','p.idproveedor','=','per.idpersona')
            ->join('categorias as c','p.idcategoria','=','c.idcategoria')
    		->select('p.idproducto','c.nombre as categoria','per.nombre as proveedor','p.nombre','p.descripcion','p.precio','p.stockactual','p.estado','p.tipo')
    		->where('p.nombre','LIKE','%'.$query.'%')
    		->where('p.estado','=','Activo')
    		->orwhere('p.idproducto','LIKE','%'.$query.'%')
    		->orderBy('nombre','ASC')
    		->paginate(6);
    		return view('almacen.producto.index',["productos"=>$productos,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	$categorias=DB::table('categorias')->where('condicion','=','1')->orderBy('nombre','asc')->get();
        $personas=DB::table('personas')->where('tipopersona','=','Proveedor')->orderBy('nombre','asc')->get();
    	return view("almacen.producto.create",["categorias"=>$categorias,"personas"=>$personas]);
    }

    public function store(ProductoFormRequest $Request)
    {
    	$producto=new Productos;
    	$producto->idcategoria=$Request->get('idcategoria');
    	$producto->idproveedor=$Request->get('idproveedor');
    	$producto->nombre=$Request->get('nombre');
    	$producto->descripcion=$Request->get('descripcion');
    	$producto->precio=$Request->get('precio');
    	$producto->stockactual=$Request->get('stockactual');
    	$producto->estado="Activo";
    	$producto->tipo=$Request->get('tipo');
        $producto->ult_inventario_fecha=$Request->get('ultinventariofecha');
        $producto->ult_inventario_stock=$Request->get('ultinventariostock');
    	$producto->save();
    	return Redirect::to('almacen/producto');    	   	
    }

    public function show(request $Request)
    {	  
      
    }

    public function edit($id)
    {
    	$producto=productos::findorFail($id);
		$categorias=DB::table('categorias')->where('condicion','=','1')->get();
        $personas=DB::table('personas')->where('tipopersona','=','Proveedor')->get();
    	return view("almacen.producto.edit",["productos"=>$producto,"categorias"=>$categorias,"personas"=>$personas]);
    }

    public function update(ProductoFormRequest $Request, $id)
    {
    	$producto=Productos::findorFail($id);
    	$producto->idcategoria=$Request->get('idcategoria');
    	$producto->idproveedor=$Request->get('idproveedor');
    	$producto->nombre=$Request->get('nombre');
    	$producto->descripcion=$Request->get('descripcion');
    	$producto->precio=$Request->get('precio');
    	$producto->stockactual=$Request->get('stockactual');
    	$producto->tipo=$Request->get('tipo');
        $producto->ult_inventario_fecha=$Request->get('ultinventariofecha');
        $producto->ult_inventario_stock=$Request->get('ultinventariostock');
    	$producto->update();
    	return Redirect::to('almacen/producto'); 
    }

    public function destroy($id)
    {
    	$producto=Productos::findorFail($id);
    	$producto->estado="Inactivo";
    	$producto->update();
    	return Redirect::to('almacen/producto'); 
    }
}
