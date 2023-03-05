<?php

namespace Transic;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table='modelos';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable=[
    	'nombre'
    ];

    protected $guarded=[
    ];
}
