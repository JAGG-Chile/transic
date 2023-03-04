<?php

namespace Transic;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table='ventas';

    protected $primaryKey='idventa';

    public $timestamps=false;

    protected $fillable=[
    	'idcliente',
    	'tipodocumento',
    	'numero',
    	'fecha',
    	'vencimiento',
    	'pago',
    	'impuesto',
    	'estado',
        'totalventa'
    ];

    protected $guarded=[
    ];
}
