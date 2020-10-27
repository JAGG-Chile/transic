<?php

namespace qbrema\Http\Controllers;

use Illuminate\Http\Request;
use qbrema\Categorias;
use Illuminate\Support\Facades\Redirect;
use qbrema\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Facades\Input;
use DB;


class CategoriaController extends Controller
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
    		$categorias=DB::table('categorias')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where ('condicion','=','1')
            ->orderBy('nombre','asc')
    		->paginate(7);           
    	   return view('almacen.categoria.index',['categorias'=>$categorias,'searchText'=>$query]);
        }
    }

    public function create()
    {
    	return view("almacen.categoria.create");
    }

    public function store(CategoriaFormRequest $Request)
    {
    	$categoria=new Categorias;
    	$categoria->nombre=$Request->get('nombre');
    	$categoria->descripcion=$Request->get('descripcion');
    	$categoria->condicion='1';
    	$categoria->save();
    	return Redirect::to('almacen/categoria');    	   	
    }

    public function show($id)
    {
    	//return view("almacen.categoria.show",["categoria"=>categoria::findorFail($id)]);
    }

    public function edit($id)
    {
    	return view("almacen.categoria.edit",["categorias"=>categorias::findorFail($id)]);
    }

    public function update(CategoriaFormRequest $Request, $id)
    {
    	$categoria=Categorias::findorFail($id);
    	$categoria->nombre=$Request->get('nombre');
    	$categoria->descripcion=$Request->get('descripcion');
    	$categoria->update();
    	return Redirect::to('almacen/categoria'); 
    }

    public function destroy($id)
    {
    	$categoria=Categorias::findorFail($id);
    	$categoria->condicion="0";
    	$categoria->update();
    	return Redirect::to('almacen/categoria'); 
    }

}
