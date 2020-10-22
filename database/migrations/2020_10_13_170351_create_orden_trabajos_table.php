<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_trabajos', function (Blueprint $table) {
          //  $table->id();
            $table->id('OrdenTrabajo_Id');
            $table->text('OrdenTrabajo_Tarea');
            $table->text('OrdenTrabajo_Cliente');
            $table->text('OrdenTrabajo_Direccion');
            $table->int('OrdenTrabajo_NConexion');
            $table->string('OrdenTrabajo_Tecnico');
            $table->datetime('OrdenTrabajo_FechaInicio');
            $table->datetime('OrdenTrabajo_FechaFin');
            $table->int('OrdenTrabajo_Porcentaje');
            $table->string('OrdenTrabajo_Color');
            $table->int('OrdenTrabajo_CodigoMaterial1');
            $table->int('OrdenTrabajo_CodigoMaterial2');
            $table->int('OrdenTrabajo_CodigoMaterial3');
            $table->int('OrdenTrabajo_CodigoMaterial4');
            $table->int('OrdenTrabajo_CodigoMaterial5');
            $table->int('OrdenTrabajo_CantidadMaterial1');
            $table->int('OrdenTrabajo_CantidadMaterial2');
            $table->int('OrdenTrabajo_CantidadMaterial3');
            $table->int('OrdenTrabajo_CantidadMaterial4');
            $table->int('OrdenTrabajo_CantidadMaterial5');
            $table->int('OrdenTrabajo_Creador');
            $table->int('OrdenTrabajo_Estado');
            $table->string('OrdenTrabajo_NewConexion');
            $table->text('OrdenTrabajo_Observacion');
            $table->int('OrdenTrabajo_Habilitacion');
            $table->int('OrdenTrabajo_Borrado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_trabajos');
    }
}



