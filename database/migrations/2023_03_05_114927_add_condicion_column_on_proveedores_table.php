<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCondicionColumnOnProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Agregar columna condicion, que resuelve si un registro esta eliminado (0) o activo (1)
        Schema::table('proveedores', function (Blueprint $table) {
            $table->boolean('condicion')->after('nombre');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropColumn('condicion');
        });
    }
}
