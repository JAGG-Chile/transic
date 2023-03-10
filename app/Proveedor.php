<?php

namespace Transic;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $primaryKey='id';

    public $timestamps = true;

    protected $fillable=[
        'nombre',
        'rut'
    ];

    protected $guarded = [
    ];
}
?>