<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCondicionColumnOnVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Agregar columna condicion, que resuelve si un registro esta eliminado (0) o activo (1)
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->boolean('condicion')->after('anio');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropColumn('condicion');
        });
    }
}
