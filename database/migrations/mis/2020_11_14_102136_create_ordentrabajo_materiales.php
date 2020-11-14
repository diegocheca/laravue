<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdentrabajaoMateriales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordentrabajo_materials', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->foreign('ordentrabajo_id')->references('id')->on('orden_trabajos');
            //$table->foreignId('ordentrabajo_id');
            //$table->foreignId('material_id');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->integer('cantidad', 6)->nullable();
            $table->timestamp('created_by', 0);
            $table->timestamps(0);
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordentrabajo_materials', function (Blueprint $table) {
            //
        });
    }
}
