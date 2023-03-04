<?php

namespace Transic;

use Illuminate\Database\Eloquent\Model;

class DetalleCompras extends Model
{
    protected $table='detalle_compras';

    protected $primaryKey='iddetallecompra';

    public $timestamps=false;

    protected $fillable=[
    	'idcompra',
    	'idproducto',
    	'cantidad',
    	'preciounitario'
    ];

    protected $guarded=[
    ];
}
