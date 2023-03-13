<?php

namespace Transic;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table='vehiculos';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable=[
    	'id_marca',
    	'id_modelo',
    	'tipo',
    	'combustible',
        'anio',
        'ppu'
    ];

    protected $guarded=[
    ];
}
