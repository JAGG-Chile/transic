<?php

namespace Transic;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table='articulos';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable=[
    	'id_proveedor',    	
    	'id_marca',
    	'id_modelo',
		'nombre',
    	'stockMinimo',
    	'stockActual',
    	'unidadMedida'		
    ];

    protected $guarded=[
    ];//
}
?>