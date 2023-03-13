<?php

namespace Transic\Http\Controllers;

use Illuminate\Http\Request;

use Transic\Vehiculo;
use Illuminate\Support\Facades\Redirect;
use Transic\Http\Requests\VehiculoFormRequest;
use Illuminate\Support\Facades\Input;
use DB;

class VehiculoController extends Controller
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
    		
    		$vehiculos=DB::table('vehiculos as v')
            ->join('marcas as mrc','v.id_marca','=','mrc.id')
            ->join('modelos as mdl','v.id_modelo','=','mdl.id')
            ->select('v.id','mrc.id as idMarca','mrc.nombre as nombreMarca','mdl.id as idModelo','mdl.nombre as nombreModelo','v.tipo','v.combustible','v.anio','v.ppu','v.condicion')
    		->where('ppu','LIKE','%'.$query.'%')
    		->orderBy('ppu','asc')
    		->paginate(7);           
    		
    		return view('administracion.vehiculo.index',["vehiculos"=>$vehiculos,"searchText"=>$query]);
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

    	return view("administracion.vehiculo.create",['marcas'=>$marcas,
                                                      'modelos'=>$modelos]);
    }

    
    public function store(VehiculoFormRequest $Request)
	{
        
        $vehiculo = new Vehiculo;

    	$vehiculo->ppu          = strtoupper($Request->get('ppu'));
    	$vehiculo->id_marca     = $Request->get('idMarca');
    	$vehiculo->id_modelo    = $Request->get('idModelo');
    	$vehiculo->tipo         = $Request->get('tipo');    	
        $vehiculo->combustible  = $Request->get('combustible');    	
        $vehiculo->anio         = $Request->get('anio');    	
		$vehiculo->condicion    = 1; 
    	
    	$vehiculo->save();

    	return Redirect::to('administracion/vehiculo');   	   	

        
    }

    public function show($id)
    {
    	//return view("compras.vehiculo.show",["vehiculos"=>vehiculo::findorFail($id)]);
    }

    public function edit($id)
    {
        $marcas=DB::table('marcas')
        //->where('condicion','=',true)    DEBE PODER TRAER MARCA INACTIVA
        ->orderBy('nombre','asc')
        ->get();

        $modelos=DB::table('modelos')
        //->where('condicion','=',true)    DEBE PODER TRAER MODELO INACTIVO
        ->orderBy('nombre','asc')
        ->get();

    	return view("administracion.vehiculo.edit",["vehiculo"=>Vehiculo::findorFail($id),
                                                    "marcas"=>$marcas,
                                                    "modelos"=>$modelos]);
    }

    public function update(VehiculoFormRequest $Request, $id)
    {
    	$vehiculo=Vehiculo::findorFail($id);

		$vehiculo->ppu          = strtoupper($Request->get('ppu'));
    	$vehiculo->id_marca     = $Request->get('idMarca');
    	$vehiculo->id_modelo    = $Request->get('idModelo');
    	$vehiculo->tipo         = $Request->get('tipo');    	
        $vehiculo->combustible  = $Request->get('combustible');    	
        $vehiculo->anio         = $Request->get('anio');  	
    	
    	$vehiculo->update();

    	return Redirect::to('administracion/vehiculo'); 
    }

    public function destroy($id)
    {
    	$vehiculo = Vehiculo::findorFail($id);

        if ($vehiculo->condicion){
            // está activo
           	$vehiculo->condicion=0;
        }else{
            $vehiculo->condicion=1;
        };
    	
        $vehiculo->update();

    	return Redirect::to('administracion/vehiculo'); 
    }
}
?>