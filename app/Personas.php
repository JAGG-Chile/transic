<?php

namespace qbrema;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table='personas';

    protected $primaryKey='idpersona';

    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'direccion',
    	'telefono',
    	'email',
    	'rut',
    	'contacto',
    	'tipopersona',
    	'descuento',
    	'credito'
    ];

    protected $guarded=[
    ];//
}
