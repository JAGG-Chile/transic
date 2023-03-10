<?php
/*
namespace Transic\Http\Controllers;

use Illuminate\Http\Request;

use Transic\Http\Requests;


class ModeloController extends Controller
{
    //
}*/

namespace Transic\Http\Controllers;

use Illuminate\Http\Request;

use Transic\Modelo;
use Illuminate\Support\Facades\Redirect;
use Transic\Http\Requests\ModeloFormRequest;
use Illuminate\Support\Facades\Input;
use DB;

class ModeloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$modelos=DB::table('modelos')
            ->where('nombre','LIKE','%'.$query.'%')                    
            ->orderBy('nombre','asc')
    		->paginate(7);           
    	   return view('administracion.modelo.index',['modelos'=>$modelos,'searchText'=>$query]);
        }
    }

    public function create()
    {
    	return view("administracion.modelo.create");
    }

    public function store(modeloFormRequest $Request)
    {
    	$modelo              = new Modelo;
    	$modelo->nombre      = strtoupper($Request->get('nombre'));
        $modelo->condicion   = 1;    // 1:activo 2:eliminado
    	$modelo->save();

    	return Redirect::to('administracion/modelo');    	   	
    }

    public function show($id)
    {
    	//
    }

    public function edit($id)
    {
    	return view("administracion.modelo.edit",["modelos"=>modelo::findorFail($id)]);
    }

    public function update(modeloFormRequest $Request, $id)
    {
    	$modelo=Modelo::findorFail($id);

    	$modelo->nombre = strtoupper($Request->get('nombre'));
    	
    	$modelo->update();

    	return Redirect::to('administracion/modelo'); 

    }

    public function destroy($id)
    {
    	$modelo = Modelo::findorFail($id);

        if ($modelo->condicion){
            // está activo
           	$modelo->condicion=0;
        }else{
            $modelo->condicion=1;
        };
    	
        $modelo->update();

    	return Redirect::to('administracion/modelo'); 
    }

}
?>