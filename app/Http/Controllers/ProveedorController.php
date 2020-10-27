<?php

namespace qbrema\Http\Controllers;

use Illuminate\Http\Request;
use qbrema\Personas;
use Illuminate\Support\Facades\Redirect;
use qbrema\Http\Requests\PersonaFormRequest;
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
    		
    		$personas=DB::table('personas')
    		->where('tipopersona','=','Proveedor')
    		->where('nombre','LIKE','%'.$query.'%')
    		->orderBy('idpersona','desc')
    		->paginate(7);
    		
    		return view('compras.proveedor.index',["personas"=>$personas,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("compras.proveedor.create");
    }

    public function store(PersonaFormRequest $Request)
    {
    	$persona=new Personas;
    	$persona->tipopersona='Proveedor';
    	$persona->nombre=$Request->get('nombre');
    	$persona->direccion=$Request->get('direccion');
    	$persona->telefono=$Request->get('telefono');
    	$persona->email=$Request->get('email');
    	$persona->contacto=$Request->get('contacto');
    	$persona->rut=$Request->get('rut');
    	$persona->save();
    	return Redirect::to('compras/proveedor');    	   	
    }

    public function show($id)
    {
    	return view("compras.proveedor.show",["personas"=>personas::findorFail($id)]);
    }

    public function edit($id)
    {
    	return view("compras.proveedor.edit",["personas"=>personas::findorFail($id)]);
    }

    public function update(PersonaFormRequest $Request, $id)
    {
    	$persona=Personas::findorFail($id);
    	$persona->nombre=$Request->get('nombre');
    	$persona->direccion=$Request->get('direccion');
    	$persona->telefono=$Request->get('telefono');
    	$persona->email=$Request->get('email');
    	$persona->contacto=$Request->get('contacto');
    	$persona->rut=$Request->get('rut');
    	$persona->update();
    	return Redirect::to('compras/proveedor'); 
    }

    public function destroy($id)
    {
    	$persona=Personas::findorFail($id);
    	$persona->tipopersona="Inactivo";
    	$persona->update();
    	return Redirect::to('compras/proveedor'); 
    }
}
