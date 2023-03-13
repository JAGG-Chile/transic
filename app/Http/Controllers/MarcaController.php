<?php
/* 
namespace Transic\Http\Controllers;

use Illuminate\Http\Request;

use Transic\Http\Requests;

class MarcaController extends Controller
{
    //
} */


namespace Transic\Http\Controllers;

use Illuminate\Http\Request;

use Transic\Marca;
use Illuminate\Support\Facades\Redirect;
use Transic\Http\Requests\MarcaFormRequest;
use Illuminate\Support\Facades\Input;
use DB;


class MarcaController extends Controller
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
    		$marcas=DB::table('marcas')
            ->where('nombre','LIKE','%'.$query.'%')                    
            ->orderBy('nombre','asc')
    		->paginate(7);           
    	   return view('administracion.marca.index',['marcas'=>$marcas,'searchText'=>$query]);
        }
    }

    public function create()
    {
    	return view("administracion.marca.create");
    }

    public function store(MarcaFormRequest $Request)
    {
        
    	$marca              = new Marca;
    	$marca->nombre      = strtoupper($Request->get('nombre'));
        $marca->condicion   = 1;    // 1:activo 2:eliminado
    	$marca->save();

    	return Redirect::to('administracion/marca');    	   	
    }

    public function show($id)
    {
    	//
    }

    public function edit($id)
    {
    	return view("administracion.marca.edit",["marcas"=>Marca::findorFail($id)]);
    }

    public function update(MarcaFormRequest $Request, $id)
    {
    	$marca=Marca::findorFail($id);

    	$marca->nombre = strtoupper($Request->get('nombre'));
    	
    	$marca->update();

    	return Redirect::to('administracion/marca'); 

    }

    public function destroy($id)
    {
    	$marca = Marca::findorFail($id);

        if ($marca->condicion){
            // está activo
           	$marca->condicion=0;
        }else{
            $marca->condicion=1;
        };
    	
        $marca->update();

    	return Redirect::to('administracion/marca'); 
    }

}
