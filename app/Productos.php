<?php

namespace qbrema;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table='productos';

    protected $primaryKey='idproducto';

    public $timestamps=false;

    protected $fillable=[
    	'idproveedor',
    	'nombre',
    	'descripcion',
    	'precio',
    	'stockminimo',
    	'stockactual',
    	'idcategoria',
    	'estado',
		'ult_inventario_fecha',
		'ult_inventario_stock'
    ];

    protected $guarded=[
    ];//
}
