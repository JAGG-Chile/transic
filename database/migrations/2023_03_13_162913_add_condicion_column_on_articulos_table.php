<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCondicionColumnOnArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Agregar columna condicion, guarda si registro esta activo o inactivo
        Schema::table('articulos', function (Blueprint $table) {
            $table->boolean('condicion')->after('saldoInicial');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articulos', function (Blueprint $table) {
            $table->dropColumn('condicion');
        });
    }
}
