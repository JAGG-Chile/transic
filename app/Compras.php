<?php

namespace qbrema;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table='compras';

    protected $primaryKey='idcompra';

    public $timestamps=false;

    protected $fillable=[
    	'idproveedor',
    	'tipodocumento',
    	'numero',
    	'fecha',
    	'vencimiento',
    	'impuesto',
    	'carpeta',
    	'estado'
    ];

    protected $guarded=[
    ];
}
