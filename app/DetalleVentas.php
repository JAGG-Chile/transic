<?php

namespace qbrema;

use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    protected $table='detalle_ventas';

    protected $primaryKey='iddetalleventa';

    public $timestamps=false;

    protected $fillable=[
    	'idventa',
    	'idproducto',
    	'cantidad',
    	'preciounitario'
    ];

    protected $guarded=[
    ];
}
