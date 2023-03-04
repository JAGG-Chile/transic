<?php

namespace Transic;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table='categorias';

    protected $primaryKey='idcategoria';

    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'descripcion',
    	'condicion'
    ];

    protected $guarded=[
    ];
}
