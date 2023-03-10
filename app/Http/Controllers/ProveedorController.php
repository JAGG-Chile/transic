<?php

namespace Transic\Http\Controllers;

use Illuminate\Http\Request;

use Transic\Proveedor;
use Illuminate\Support\Facades\Redirect;
use Transic\Http\Requests\ProveedorFormRequest;
use Illuminate\Support\Facades\Input;
use DB;

class ProveedorController extends Controller
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
    		
    		$proveedores=DB::table('proveedores')
    		->where('nombre','LIKE','%'.$query.'%')
    		->orderBy('id','asc')
    		->paginate(7);
    		
    		return view('administracion.proveedor.index',["proveedores"=>$proveedores,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("administracion.proveedor.create");
    }

    public function store(ProveedorFormRequest $Request)
	{
    	$proveedor=new Proveedor;
    	$proveedor->rut=$Request->get('rut');
    	$proveedor->nombre=strtoupper($Request->get('nombre'));
    	$proveedor->direccion=$Request->get('direccion');
    	$proveedor->telefono=$Request->get('telefono');
    	$proveedor->email=$Request->get('email');    	
		$proveedor->condicion=1; 
    	
    	$proveedor->save();

    	return Redirect::to('administracion/proveedor');    	   	
    }

    public function show($id)
    {
    	//return view("compras.proveedor.show",["personas"=>personas::findorFail($id)]);
    }

    public function edit($id)
    {
    	return view("administracion.proveedor.edit",["proveedor"=>Proveedor::findorFail($id)]);
    }

    public function update(ProveedorFormRequest $Request, $id)
    {
    	$proveedor=Proveedor::findorFail($id);

		$proveedor->rut=$Request->get('rut');
    	$proveedor->nombre=strtoupper($Request->get('nombre'));
    	$proveedor->direccion=$Request->get('direccion');
    	$proveedor->telefono=$Request->get('telefono');
    	$proveedor->email=$Request->get('email');    	
    	
    	$proveedor->update();

    	return Redirect::to('administracion/proveedor'); 
    }

    public function destroy($id)
    {
    	$proveedor = Proveedor::findorFail($id);

        if ($proveedor->condicion){
            // está activo
           	$proveedor->condicion=0;
        }else{
            $proveedor->condicion=1;
        };
    	
        $proveedor->update();

    	return Redirect::to('administracion/proveedor'); 
    }
}
?>