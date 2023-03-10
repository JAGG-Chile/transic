<?php

namespace Transic;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table='marcas';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable=[
    	'nombre'
    ];

    protected $guarded=[
    ];
}
?>
