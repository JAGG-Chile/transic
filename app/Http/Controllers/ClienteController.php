<?php

namespace qbrema\Http\Controllers;

use Illuminate\Http\Request;
use qbrema\Personas;
use Illuminate\Support\Facades\Redirect;
use qbrema\Http\Requests\PersonaFormRequest;
use DB;

class ClienteController extends Controller
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

        return view('pdf.consulta_deudaxcliente',['personas'=>$personas]);
    }
    
    
    public function index(Request $Request)
    {
    	if ($Request)
    	{
    		$query=trim($Request->get('searchText'));
    		
    		$personas=DB::table('personas')
    		->where('tipopersona','=','Cliente')
    		->where('nombre','LIKE','%'.$query.'%')
    		->orderBy('nombre','asc')
    		->paginate(7);
    		
    		return view('ventas.cliente.index',["personas"=>$personas,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("ventas.cliente.create");
    }

    public function store(PersonaFormRequest $Request)
    {
    	$persona=new Personas;
    	$persona->tipopersona='Cliente';
    	$persona->nombre=strtoupper($Request->get('nombre'));
    	$persona->direccion=$Request->get('direccion');
    	$persona->telefono=$Request->get('telefono');
    	$persona->email=$Request->get('email');
    	$persona->contacto=$Request->get('contacto');
    	$persona->rut=$Request->get('rut');
    	$persona->descuento=$Request->get('descuento');
    	$persona->credito=$Request->get('credito');
       	$persona->save();
    	return Redirect::to('ventas/cliente');    	   	
    }

    public function show($id)
    {
    	return view("ventas.cliente.show",["personas"=>personas::findorFail($id)]);
    }

    public function edit($id)
    {
    	return view("ventas.cliente.edit",["personas"=>personas::findorFail($id)]);
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
    	$persona->descuento=$Request->get('descuento');
    	$persona->credito=$Request->get('credito');
    	$persona->update();
    	return Redirect::to('ventas/cliente'); 
    }

    public function destroy($id)
    {
    	$persona=Personas::findorFail($id);
    	$persona->tipopersona="Inactivo";
    	$persona->update();
    	return Redirect::to('ventas/cliente'); 
    }//
}
