<?php

namespace qbrema;

use Illuminate\Database\Eloquent\Model;

class pagos_compras extends Model
{
    protected $table='pagos_compras';

    protected $primaryKey='idpagocompra';

    public $timestamps=false;

    protected $fillable=[
    	'idcompra',
    	'fecha',
    	'monto',
    	'formapago',
    	'detalle',
    	'tipopago'
    ];

    protected $guarded=[
    ];
}
